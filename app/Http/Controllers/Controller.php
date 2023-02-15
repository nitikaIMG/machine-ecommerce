<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Vars\Roles;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Guard string. // web, api
     * 
     * @var string
     */
    protected $guard = 'web';

    /**
     * Authentication driver.
     *
     * @var \Illuminate\Auth\SessionGuard|\Tymon\JWTAuth\JWTGuard
     */
    protected $auth;

    public function __construct()
    {
        $this->auth = $this->authManager();
    }


    /**
     * Authentication driver.
     *
     * @return \Illuminate\Auth\SessionGuard|\Tymon\JWTAuth\JWTGuard
     */
    protected function authManager()
    {
        return auth($this->guard);
    }

    /**
     * Return current logged in user.
     *
     * @return \App\Models\User|null
     */
    public function user()
    {
        if( !$this->auth ) {
            $this->auth = $this->authManager();
        }
        
        return $this->auth->user();
    }


    // user can login:

    // either phone,email verified
    // status == 1
    // deactivated_till == null or passed
    protected function check_user(User $auth_user)
    {
        // if (intval($auth_user->status) !== 1) {
        //     return __('Account inactive');
        // }

        // if seller not verified
        if ($auth_user->role === Roles::SELLER && empty($auth_user->seller_verified)) {
            return __('Account verification pending');
        }

        if (empty($auth_user->otp_verified_at) && empty($auth_user->email_verified_at)) {
            return __('Please verify your email or phone');
        }

        // if account temporarily deactivated
        if (!empty($auth_user->deactivated_till)) {

            if (now()->le($auth_user->deactivated_till)) {
                return __('Your account is temporarily blocked. Please try again after some time.');
            }
        }

        return true;
    }

    public function isRequestForWeb()
    {
        return $this->guard === 'web';
    }

    protected function validation_error_response(Validator $validator)
    {
        $_errors = $validator->errors()->messages();

        return response()->json([
            'status' => false,
            'data' => [
                'error' => $_errors
            ]
        ]);
    }
}
