<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserShop;
use App\Vars\UserStatus;
use App\Models\UserShopPhoto;
use App\Models\VerifyUser;
use App\Vars\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\RequiredIf;
use Session;
use App\Http\Resources\User as ResourcesUser;
use App\Mail\CustomerVerify;
use Validator;
use Auth;
use App\Traits\SendSMS;
use Mail;

class AuthController extends Controller
{
    use SendSMS;
    public function login()
    {
        return view('customer.login');
    }

    public function login_admin()
    {
        return view('admin.login');
    }

    public function login_seller()
    {
        return view('seller.auth.login');
    }

    public function login_customer()
    {
        return view('customer.auth.login');
    }

    public function login_action(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if( ! $this->auth->validate($validated) ) {
            return back()->withError(__('Invalid email address or password'));
        }

        $auth_user = User::where('email', $request->get('email'))->firstOrFail();

        if( intval($auth_user->status) === 0 ) {
            return back()->withError(__('Account inactive'));
        }

        $redirect = redirect('/');

        /*for seller login*/  

        switch( $auth_user->role ) {
            case Roles::SELLER:
                // if seller not verified
                if(empty($auth_user->seller_verified) ) {
                    return back()->withError(__('Account verification pending'));
                }

                // if customer,seller email not verified
                if( empty($auth_user->email_verified_at) ) {
                    return back()->withError(__('Please verify your email address'));
                }

                if( config('app.verify_otp') && empty($auth_user->otp_verified_at) ) {
                    return back()->withError(__('Please verify your phone number'));
                }
        
                // if account temporarily deactivated
                if( !empty($auth_user->deactivated_till) ) {
        
                    if( now()->le($auth_user->deactivated_till) ) {
                        return back()->withError(__('Your account is temporarily blocked. Please try again after some time.'));
                    }
                }

                $redirect = redirect(route('seller.dashboard'));
                break;
            
            case Roles::CUSTOMER:
                // if customer,seller email not verified
                if( empty($auth_user->email_verified_at) ) {
                    return back()->withError(__('Please verify your email address'));
                }

                if( config('app.verify_otp') && empty($auth_user->otp_verified_at) ) {
                    return back()->withError(__('Please verify your phone number'));
                }
        
                // if account temporarily deactivated
                if( !empty($auth_user->deactivated_till) ) {
        
                    if( now()->le($auth_user->deactivated_till) ) {
                        return back()->withError(__('Your account is temporarily blocked. Please try again after some time.'));
                    }
                }

                $redirect = redirect(route('home'));
                break;
            case Roles::ADMIN:
            case Roles::SUPER_ADMIN:
                $redirect = redirect('admin');
                break;
        }

        $this->auth->login($auth_user, $request->has('remember_me'));

        return $redirect->withSuccess(__('Logged in successfully'));
    }

    public function login_seller_action(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if( ! $this->auth->validate($validated) ) {
            return back()->withError(__('Invalid email address or password'));
        }

        $auth_user = User::where('email', $request->get('email'))->firstOrFail();

        if(isset($auth_user)&& $auth_user->role!="seller"){
            return back()->with('error','Unauthorized! Not a valid  seller.');
        }

        if( intval($auth_user->status) === 0 ) {
            return back()->withError(__('Account inactive'));
        }

        // if seller not verified
        if( $auth_user->role === Roles::SELLER && empty($auth_user->seller_verified) ) {
            return back()->withError(__('Account verification pending'));
        }

        // if customer,seller email not verified
        if( empty($auth_user->email_verified_at) ) {
            return back()->withError(__('Please verify your email address'));
        }

        if( config('app.verify_otp') && empty($auth_user->otp_verified_at) ) {
            return back()->withError(__('Please verify your phone number'));
        }

        // if account temporarily deactivated
        if( !empty($auth_user->deactivated_till) ) {

            if( now()->le($auth_user->deactivated_till) ) {
                return back()->withError(__('Your account is temporarily blocked. Please try again after some time.'));
            }
        }

        $this->auth->login($auth_user, $request->has('remember_me'));

        $redirect = redirect('/');
        if($auth_user->role == "seller"){
            $redirect = redirect(route('seller.dashboard'));
        }
        // switch( $auth_user->role ) {
        //     case Roles::ADMIN:
        //     case Roles::SUPER_ADMIN:
        //         $redirect = redirect('admin');
        //         break;

        //     case Roles::SELLER:
        //         $redirect = redirect('seller');
        //         break;
        // }

        return $redirect->withSuccess(__('Logged in successfully'));
    }

    public function register(Request $request)
    {
        //
    }

    public function send_otp_for_login(Request $request){
        $data = $request->validate([
            'type'            => ['nullable', 'in:customer,seller'],
            'email_or_phone'   => ['required', 'max:191', 'email_or_phone']
        ]);
        $email_phone = $request->get('email_or_phone');
        try {
        $user = User::withoutGlobalScope('active')
            ->where('email', $email_phone)
            ->orWhere('phone', $email_phone)
            ->first();

        $field = boolval(filter_var($email_phone, FILTER_VALIDATE_EMAIL))
            ? 'email': 'phone';
        // create new user
        if(empty($user->email_verified_at) AND empty($user->otp_verified_at)) {
            $registering_as = $request->get('type');
            if(empty($registering_as) ) {
                return json_encode(['status'=> 0, 'message'=>'Invalid user type for registration']);
            }
            if(empty($user)){
                $user = User::create([
                    $field => $email_phone
                ]);

                if( $registering_as == 'customer' ) {
                    $user->syncRoles([Roles::CUSTOMER]);
                }
                else if( $registering_as == 'seller' ) {
                    $user->syncRoles([Roles::SELLER]);
                }
                else {
                    return json_encode(['status'=> 0, 'message'=>'Invalid role']);
                }
             }
        }
        else{
            return json_encode(['status'=> 0, 'message'=>'Entered email/phone already exists']);
        }
//        $user_otp = rand(1000,9999);
        $user_otp = "1234";
        if($field == 'phone'){
            //$this->sendSms($email_phone,$user_otp);
        }else if($field == 'email'){
            $userdata = [
                'otp' =>$user_otp,
            ];
            Mail::to($email_phone)->send(new CustomerVerify($userdata));
        }
        $user->otp = $otp = Hash::make($user_otp);
        $user->update();

        // TODO: send otp mail & sms
        return json_encode(['status'=> 1, 'email_phone' =>$email_phone, 'message'=>'OTP sent to registered phone/email']);
    
        } catch(\Exception $e) {
            logger($e->getMessage());
        }
    }

    public function otp_for_verify(Request $request){

        $data = $request->validate([
            'otp' => ['required', 'max:10'],
            'email_or_phone'   => ['required', 'max:191', 'email_or_phone']
        ]);
        $email_phone = $request->get('email_or_phone');

        $user = User::withoutGlobalScope('active')
            ->where('email', $email_phone)
            ->orWhere('phone', $email_phone)
            ->first();

        if(!Hash::check($request->get('otp'), $user->otp) ) {
            return json_encode(['status'=> 0, 'message'=>'OTP sent to registered phone/email']);
        }
        $this->auth->login($user, $request->has('remember_me'));

        if( now()->gt( $user->updated_at->addMinutes(15) ) ) {
            return json_encode(['status'=> 0, 'message'=>'Time expired to verify OTP. Please regenerate and verify again.']);
        }

        $user->otp = NULL;
        $user->otp_verified_at = date("Y-m-d H:i:s");

        // TODO: send otp mail & sms

        $user->status = 1;

        // TODO: check if seller can be marked verified
        if( $user->role === Roles::SELLER ) {
            $user->seller_verified = 1;
        }

        $user->update();
        return json_encode(['status'=> 1,'user'=>$user,'message'=>'OTP verified successfully']);
    }
    public function update_account(Request $request)
    {
         $request->all();
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:191'],
            'email'                 => ['required','unique:users,email,'.auth()->user()->id, 'max:191', 'email'],
            'mobile'                => ['required','unique:users,phone,'.auth()->user()->id, 'digits_between:8,12'],
            'password'              => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required'],
        ]);

        try {
              $data = $user = User::withoutGlobalScope('active')
             ->where('id', auth()->user()->id)
             ->first();
             
            if(!empty($data)){
                 $input = User::find($data->id);
                if(empty($input->email)){
                    $input['email'] = $request->email;
                }

                if(empty($input->phone)){
                    $input['phone_code'] = $request->phone_code;
                    $input['phone'] = $request->mobile;
                }

                $input['name'] = $request->name;
                $input['password'] = Hash::make($request->password);
               $input->save();
              
            }else{
                return json_encode(['status'=> 0, 'message'=>'User Not Found']);
            }
            // TODO: send otp mail & sms
            $roles = $input->getRoleStrAttribute();
            return json_encode(['status'=> 1,'roles'=>$roles, 'message'=>'Account Update.']);
            

        } catch(\Exception $e) {
            logger($e->getMessage());
        }
    }

    public function register_action_old(Request $request)
    {
        $registering_as = $request->get('as') ?? 'customer';

        $data = $request->validate([
            'as'                    => ['nullable', 'in:customer,seller'],
            'name'                  => ['required', 'string', 'max:191'],
            'email'                 => ['required', 'max:191', 'email'],
            'mobile'                => ['required', 'digits_between:8,12'],
            'password'              => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required'],
            'shop_name'     => [
                new RequiredIf($registering_as === 'seller'),
                'max:191'
            ],
            'shop_email'     => [
                new RequiredIf($registering_as === 'seller'),
                'email',
                'max:191'
            ],
            'shop_number'     => [
                new RequiredIf($registering_as === 'seller'),
                'digits_between:8,12'
            ],
            
            'registration_no' => ['nullable', 'max:191'],
            'country'         => ['nullable', 'max:4'],
            'state'           => ['nullable', 'max:191'],
            'address_1'       => ['nullable', 'max:191'],
            'address_2'       => ['nullable', 'max:191'],

            'latitude'       => ['nullable', 'max:191', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude'      => ['nullable', 'max:191', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        try {
            if($registering_as == 'customer'){
              return  $user = User::withoutGlobalScope('active')
                ->where('email', $request->email)
                ->orWhere('phone', $request->mobile)
                ->first();
            }
            if(empty($user)){

                $data['password'] = Hash::make($data['password']);

                $data['otp'] = $otp = Hash::make(generate_otp());

                $user = User::create($data);
                if( $registering_as == 'customer' ) {
                    $user->syncRoles([Roles::CUSTOMER]);
                }
                else if( $registering_as == 'seller' ) {
                    $user->syncRoles([Roles::SELLER]);
                }

                $data['user_id'] = $user->id;
                if($registering_as == 'seller'){
                    UserShop::create($data);
                }
            }else{
                return json_encode(['status'=> 0, 'message'=>'Entered email/phone already exists']);
            }

            // TODO: send otp mail & sms
            if($registering_as === 'customer'){
                return json_encode(['status'=> 1, 'message'=>'Account created. OTP sent to registered number.']);
            }else if($registering_as === 'seller'){
                return json_encode(['status'=> 1, 'message'=>'Account created.']);
            }  
            else{
                return back()->withSuccess(__('Account created. OTP sent to registered number.'));

            }

        } catch(\Exception $e) {
            logger($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $auth_user = $this->user();

        $this->auth->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $redirect = redirect('/');

        if( $auth_user->role != Roles::CUSTOMER ) {
            $redirect = redirect('admin/login');
        }
        if($auth_user->role == Roles::CUSTOMER){
            $redirect = redirect('home');
        }

        return $redirect->withInfo(__('Logged out successfully'));
    }

    public function forgot_password(Request $request)
    {
        $data = $request->validate([
            'otp' => ['required_with:password', 'max:10'],
            'password' => ['required_with:otp', 'confirmed'],

            'email_or_phone'   => ['required', 'max:191', 'email_or_phone']
        ]);

        $email_phone = $request->get('email_or_phone');

        $field = boolval(filter_var($email_phone, FILTER_VALIDATE_EMAIL))
            ? 'email': 'phone';

        $user = User::withoutGlobalScope('active')
            ->where('email', $email_phone)
            ->orWhere('phone', $email_phone)
            ->first();
        if($user){
        // verify otp and udpate password
        if( $otp = $request->get('otp') ) {

            if( ! Hash::check($otp, $user->otp) ) {
                return json_encode(['status'=>0, 'message'=>'Incorrect OTP. Please enter a valid OTP.']);
            }

            if( now()->gt( $user->updated_at->addMinutes(2) ) ) {
                return json_encode(['status'=>0, 'message'=>'Time expired to verify OTP. Please regenerate and verify again.']);
               
            }

            $user->password = Hash::make($request->get('password'));
            $user->update();

            return json_encode(['status'=> 1, 'message'=>'Password reset successfully.']);
        }

        // password reset email
        if( $field === 'email' ) {
            $user_otp = "1234";
            $token = encrypt([
                'id' => $user->id,
                'datetime' => date('Y-m-d H:i')
            ]);
            $userdata = [
                'otp' =>$user_otp,
            ];
            Mail::to($email_phone)->send(new CustomerVerify($userdata));
	   $user->otp = $otp = Hash::make($user_otp);
           $user->update();
            // TODO: event forgot password
            return json_encode(['status'=> 1,'email_or_phone'=>$user->email, 'field' =>$field, 'message'=>'Password reset mail sent to registered email']);
        }else{
           // $user_otp = rand(1000,9999);
            $user_otp = "1234";
            $this->sendSms($email_phone,$user_otp);
        }

         $user->otp = $otp = Hash::make($user_otp);
         $user->update();

        //TODO: event forgot password
        return json_encode(['status'=> 1,'email_or_phone'=>$user->phone,'field' =>$field, 'message'=>'OTP sent to registered phone number']);
   
    }else{
        return json_encode(['status'=>0, 'message'=>'Incorrect Email/Phone Number. Please enter a valid Email/Phone Number.']); 
    }
    }


    public function reset_password(Request $request)
    {
        if( $request->isMethod('post') ) {

            $request->validate([
                'password' => ['required', 'min:6', 'confirmed'],
                'hash' => ['required']
            ]);

            $user = intval(decrypt($request->get('hash')));

            if( empty($user) ) {
                return redirect('/');
            }

            $user = User::find($user);

            if( empty($user) ) {
                return redirect('/');
            }

            $user->password = Hash::make($request->get('password'));
            $user->update();

            // TODO: new event and send mail

            $redirect = redirect('/');

            if( $user->role != Roles::CUSTOMER ) {
                $redirect = redirect('admin/login');
            }

            return $redirect->withSuccess(__('Password reset successful'));
        }
    }


    public function verify_otp_email(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'type' => ['nullable', 'in:otp,email']
        ]);

        $type = $request->get('type') ?? 'email';

        $verifyuser = VerifyUser::where('token', $request->query('token'))
            ->firstOrFail();

        $user = $verifyuser->user;

        if( empty($user) ) {
            return redirect('/')->withError(__('Something went wrong'));
        }

        if( $type == 'email' && ! $user->email_verified_at ) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
        }
        elseif( $type == 'otp' && ! $user->otp_verified_at ) {
            $user->otp_verified_at = date('Y-m-d H:i:s');
            $user->save();
        }

        $this->auth->logout();

        $redirect = redirect('/');

        if( $user->role != Roles::CUSTOMER ) {
            $redirect = redirect('admin/login');
        }

        // TODO: new event and send mail

        return $redirect->withSuccess(__('Account verified'));
    }

    public function shop_create(Request $request){
        $validator = $request->validate([
            'shop_phone_number'         => ['required', 'digits_between:8,12'],
            'shop_email'         => ['required', 'email', 'max:25'],
            'shop_name'     => ['required', 'string', 'min:4', 'max:50'],
            'shop_owner'     => ['required', 'string', 'min:4', 'max:30'],
            // 'file'        => ['image', 'mimes:jpeg,png,jpg,gif'],
        ]);

        $arr = $request->working_days;
        $weekday = implode(",",$arr);
        $user = Auth::user() ?? null;
        if(!empty($user))
        $store  = UserShop::create([
            'user_id'=>$user->id,
            'shop_owner'=>$validator['shop_owner'],
            'shop_name'=>$validator['shop_name'],
            'shop_email'=>$validator['shop_email'],
            'shop_contact'=>$validator['shop_phone_number'],
            'registration_no'=>isset($validator['registration']) ? $validator['registration'] : '',
            'country'=>$request->country,
            'state'=>$request->state,
            'address_1'=>$request->address,
            'address_2'=>$request->address2,
            'id_document'=>$file_path ?? null,
            'working_days'=>$weekday,
            'working_hours_from' => $request->work_hours_from,'working_hours_to' => $request->work_hours_to,
            'latitude'=>$request->lat,
            'longitude'=>$request->lng
        ]);
        
        
        if ($request->hasfile('file')) {
            //return $store;
            foreach ($request->file('file') as $file) {
                $file_path = $file->store('shops_photos', 'public');
                $validator['file'] = $file_path;
                 $user_company_photos = UserShopPhoto::create([
                    'user_shop_id'    => $store->id,
                    'photo'   => $file_path,
                ]);
            }
        }

       if($store)
        return json_encode(['status'=> 1, 'message'=>'Shop Created successfully.']);
    }
}
