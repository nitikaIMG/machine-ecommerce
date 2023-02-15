<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\User as ResourcesUser;
use App\Models\User;
use App\Services\Api\ApiResponse;
use App\Vars\Roles;
use App\Vars\UserStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;
use App\Traits\SendSMS;
use Mail;
use App\Mail\CustomerVerify;
use App\Mail\SellerVerify;

// login/registration controller for seller(vendor),customer
class AuthController extends ApiController
{
    use SendSMS;
    public function login(Request $request)
    {
        $email = $request->get('email_or_phone');

        $validator = Validator::make($request->all(), [
            'password'      => ['required'],
        ]);
        $validator->after(function ($validator) use ($request) {
            $u = User::where('email', $request->get('email_or_phone'))
                ->orWhere('phone', $request->get('email_or_phone'))
                ->first();

            if (!isset($u)) {
                $email_phone = $request->get('email_or_phone');
                $field = boolval(filter_var($email_phone, FILTER_VALIDATE_EMAIL))
                    ? 'email' : 'phone';
                if ($field == 'phone') {
                    $validator->errors()->add('email_or_phone', 'The selected phone is invalid.');
                } else if ($field == 'email') {
                    $validator->errors()->add('email_or_phone', 'The selected email is invalid.');
                } else {
                    $validator->errors()->add('email_or_phone', 'The selected email or phone is invalid.');
                }
                // if (!is_numeric($request->get('email_or_phone')) == true) {

                //     $validator->errors()->add('email_or_phone', 'The selected phone is invalid.');
                // }
            }

            // if (!isset($u)) {
            //     $validator->errors()->add('email_or_phone', 'The selected email or phone is invalid.');
            // }
        });

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        $field = boolval(filter_var($email, FILTER_VALIDATE_EMAIL))
            ? 'email' : 'phone';

        $credentials = [
            $field => $email, 'password' => $request->get('password')
        ];

        if (!$this->auth->validate($credentials)) {
            return ApiResponse::forbidden(__('Invalid password'));
        }

        $auth_user = User::withoutGlobalScope('active')
            ->where('email', $email)
            ->orWhere('phone', $email)
            ->first();

        $check_user = $this->check_user($auth_user);

        if ($check_user !== true) {
            return ApiResponse::forbidden($check_user);
        }
        $access_token = $this->auth->login($auth_user);
        if(isset($request->device_token)){
            User::where('id',$auth_user->id)->update(['device_token'=>$request->device_token]);
        }
        return ApiResponse::ok(
            __('Logged in'),
            [
                'access_token' => $access_token,
                'token_type' => 'bearer',
                'expires_in' => $this->auth->factory()->getTTL() * 60,
                'user' => new ResourcesUser($auth_user)
            ]
        );
    }

    // existing or current user
    public function send_otp_for_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'            => ['nullable', 'in:customer,seller'],
            'email_or_phone'   => ['required', 'max:191']
        ]);

        $validator->after(function ($validator) use ($request) {

            $u = User::where('email', $request->get('email_or_phone'))
                ->orWhere('phone', $request->get('email_or_phone'))
                ->first();
            $email_phone = $request->get('email_or_phone');
            $field = boolval(filter_var($email_phone, FILTER_VALIDATE_EMAIL))
                ? 'email' : 'phone';
            // if (!empty($u)) {

            //     // if ($field == 'phone') {
            //     //     $validator->errors()->add('email_or_phone', 'The selected phone is invalid.');
            //     // } else if ($field == 'email') {
            //     //     $validator->errors()->add('email_or_phone', 'The selected email is invalid.');
            //     // } else {
            //     //     $validator->errors()->add('email_or_phone', 'The selected email or phone is invalid.');
            //     // }
            // }
        });
        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }
       $email_phone = $request->get('email_or_phone');
        $field = boolval(filter_var($email_phone, FILTER_VALIDATE_EMAIL))
            ? 'email' : 'phone';
        $user = User::withoutGlobalScope('active')
            ->where('email', $email_phone)
            ->orWhere('phone', $email_phone)
            ->first();
        // create new user
        if (empty($user)) {

            $registering_as = $request->get('type');

            if (empty($registering_as)) {

                return ApiResponse::error(
                    __('Invalid user type for registration'),
                    ['requires_registration' => 1]
                );
            }

            $user = User::create([
                $field => $email_phone
            ]);

            if ($registering_as == 'customer') {
                $user->syncRoles([Roles::CUSTOMER]);
            } else if ($registering_as == 'seller') {
                $user->syncRoles([Roles::SELLER]);
            } else {
                throw new \Exception('Invalid role');
            }
        } 
	else{
            return json_encode(['status'=> 0, 'message'=>'Entered email/phone already exists']);
        }

        $user_otp = '1234';
        if ($field == 'phone') {
            // $user_otp = rand(1000, 9999);
        //    if(!$this->sendSms($email_phone, $user_otp)){
        //         $user_otp = '1234';
        //    }
        }else if($field == 'email'){
            $user_otp = rand(1000, 9999);
            $userdata = [
                'otp' =>$user_otp,
            ];
            if ($registering_as == 'seller') {
                if(!$this->sendverifyMailSeller($email_phone, $userdata)){
                    $user_otp = '1234';
                }
            }else{
                if(!$this->sendverifyMail($email_phone, $userdata)){
                    $user_otp = '1234';
                }
            }
        }
        $user->otp = $otp = Hash::make($user_otp);
        $user->update();

        // TODO: send otp mail & sms

        return ApiResponse::ok(__('OTP sent to registered phone/email'));
    }

    public function verify_otp_and_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => ['required', 'max:10'],
            'email_or_phone'   => ['required', 'max:191', 'email_or_phone']
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        $email_phone = $request->get('email_or_phone');

        $user = User::withoutGlobalScope('active')
            ->where('email', $email_phone)
            ->orWhere('phone', $email_phone)
            ->first();

        if (!Hash::check($request->get('otp'), $user->otp)) {
            return ApiResponse::validation(__('Incorrect OTP. Please enter a valid OTP.'));
        }

        if (now()->gt($user->updated_at->addMinutes(15))) {
            return ApiResponse::validation(__('Time expired to verify OTP. Please regenerate and verify again.'));
        }

        $user->otp = NULL;
        $user->otp_verified_at = date("Y-m-d H:i:s");

        // TODO: send otp mail & sms

        $user->status = UserStatus::OK;

        // TODO: check if seller can be marked verified
        if ($user->role === Roles::SELLER) {
            $user->seller_verified = 1;
        }

        $user->update();

        return ApiResponse::ok(__('OTP verified successfully.'), [
            'access_token' => $this->auth->login($user),
            'token_type' => 'bearer',
            'expires_in' => $this->auth->factory()->getTTL() * 60,
            'user' => new ResourcesUser($user)
        ]);
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => ['required_with:password', 'max:10'],
            'password' => ['required_with:otp', 'confirmed'],

            'email_or_phone'   => ['required', 'max:191', 'email_or_phone']
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        $email_phone = $request->get('email_or_phone');

        $field = boolval(filter_var($email_phone, FILTER_VALIDATE_EMAIL))
            ? 'email' : 'phone';

        $user = User::withoutGlobalScope('active')
            ->where('email', $email_phone)
            ->orWhere('phone', $email_phone)
            ->firstOrFail();

        // verify otp and udpate password
        if ($otp = $request->get('otp')) {

            if (!Hash::check($otp, $user->otp)) {
                return ApiResponse::validation(__('Incorrect OTP. Please enter a valid OTP.'));
            }

            if (now()->gt($user->updated_at->addMinutes(15))) {
                return ApiResponse::validation(__('Time expired to verify OTP. Please regenerate and verify again.'));
            }

            $user->password = Hash::make($request->get('password'));
            $user->update();

            return ApiResponse::ok(__('Password reset successfully'));
        }
        $user_otp = '1234';

        // password reset email
        if ($field === 'email') {

            $token = encrypt([
                'id' => $user->id,
                'datetime' => date('Y-m-d H:i')
            ]);
            $userdata = [
                'otp' =>$user_otp,
            ];
            Mail::to($email_phone)->send(new CustomerVerify($userdata));
            // TODO: event forgot password
	$user->otp = $otp = Hash::make($user_otp);
        $user->update();
            return ApiResponse::ok(__('Password reset mail sent to registered email'));
        } else {
            $user_otp = rand(1000, 9999);
	$user->otp = $otp = Hash::make($user_otp);
        $user->update();
            $this->sendSms($email_phone, $user_otp);
        }

        

        //TODO: event forgot password

        return ApiResponse::ok(__('OTP sent to registered phone number'));
    }

    public function logout()
    {
         $user = auth()->user();
        User::where('id',$user->id)->update(['device_token'=>'']);
        $this->auth->logout();
        return ApiResponse::ok(__('Logged out successfully'));
    }

    function sendverifyMail($email_phone,$userdata){
        Mail::to($email_phone)->send(new CustomerVerify($userdata));
        return true;
    }

    function sendverifyMailSeller($email_phone,$userdata){
        Mail::to($email_phone)->send(new SellerVerify($userdata));
        return true;
    }
}
