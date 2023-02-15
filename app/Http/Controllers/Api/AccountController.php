<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\User as ResourcesUser;
use App\Models\UserShop;
use App\Models\UserShopPhoto;
use App\Services\Api\ApiResponse;
use App\Vars\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends ApiController
{
    public function update_account(Request $request)
    {
        $user = $this->user();

        $validator = Validator::make($request->all(), [
            'name'          => ['nullable', 'string', 'max:191'],
            'email'         => ['nullable', 'max:191', 'email', 'unique:users,email,'.$user->id],
            'phone_code'    => ['nullable', 'max:10'],
            'phone'         => ['nullable', 'digits_between:8,12', 'unique:users,phone,'.$user->id],
            'profile_pic'   => ['nullable', 'mimes:jpeg,png,jpg,gif', 'max:100'],
            'old_password'  => ['nullable'],
            'password'      => ['nullable', 'confirmed'],
            'shop_owner'     => ['nullable', 'max:191'],
            'shop_name'     => ['nullable', 'max:191'],
            'shop_email'     => ['nullable', 'max:191', 'email'],
            'shop_number'     => ['nullable', 'digits_between:8,18'],
            
            'registration_no' => ['nullable', 'max:191'],
            'country'         => ['nullable', 'max:4'],
            'state'           => ['nullable', 'max:191'],
            'address_1'       => ['nullable', 'max:191'],
            'address_2'       => ['nullable', 'max:191'],

            'product_categories' => ['nullable', 'array', 'max:5'],
            'product_categories.*' => ['numeric',
                Rule::exists('product_categories','id')->where(function($query) {
                    $query->whereNull('parent_id');
                })
            ],

            'working_hours_from' => ['nullable', 'date_format:H:i'],
            'working_hours_to' => ['nullable', 'date_format:H:i', 'after:working_hours_from'],

            'working_days[]'     => ['nullable', 'max:7'],
            'working_days.*'     => ['in:Su,Mo,Tu,We,Th,Fr,Sa'],

            'photos'          => ['nullable', 'array', 'max:6'],
            'photos.*'        => ['nullable', 'mimes:jpeg,png,jpg,gif', 'max:2500'],

            'latitude'       => ['nullable', 'max:191', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude'      => ['nullable', 'max:191', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        DB::beginTransaction();

        try {
            $data = $validator->validated();

            if( empty($data) ) {
                throw new \Exception("update_account - invalid data");
            }

            // password update
            if( isset($data['old_password']) && isset($data['password']) ) {

                if( Hash::check($data['old_password'], $user->password) ) {

                    $user->password = Hash::make($data['password']);
                    $user->update();

                    return ApiResponse::ok(__('Password updated'));
                }

                return ApiResponse::error(__('Old password is incorrect'));
            }

            if( isset($user->email) ) {
                unset($data['email']);
            }

            if( isset($user->phone) ) {
                unset($data['phone']);
            }

            if( empty($user->password) && isset($data['password']) ) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            if( $profile_pic = $request->file('profile_pic') ) {
                if( $profile_pic = $profile_pic->store('user_images', 'public') ) {
                    $data['profile_pic'] = $profile_pic;
                }
            }

            if( isset($data['working_days']) ) {
                $data['working_days'] = \implode(',', $data['working_days']);
            }

            $user->fill($data);

            $user->status = UserStatus::OK;
            $user->onboarded = 1;

            $data['user_id'] = $user->id;

            if( $user->isSeller() ) {

                if( !isset($data['shop_owner']) && isset($data['name']) ) {
                    $data['shop_owner'] = $data['name'];
                }

                $userShop = UserShop::firstOrCreate(
                    ['user_id' => $user->id], $data
                );
    
                $shop_photos = [];
    
                foreach( (array)$request->file('photos') as $photo ) {
                    if( $photo = $photo->store('shops_photos', 'public') ) {
    
                        $shop_photos[] = [
                            'user_shop_id' => $userShop->id,
                            'photo' => $photo
                        ];
                    }
                }
    
                if( !empty($shop_photos) ) {
                    UserShopPhoto::insert($shop_photos);
                }

                if( ! empty( $product_categories = (array)$request->get('product_categories') ) ) {
                    $userShop->categories()
                        ->sync($product_categories);
                }
            }

            if( ! $user->addresses()->exists() ) {
                $user->addresses()->create($data);
            }

            $user->update();

            DB::commit();

            return ApiResponse::ok(__('Account updated'), new ResourcesUser($user));

        } catch(\Exception $e) {
            logger($e->getMessage());
        }

        DB::rollBack();

        return ApiResponse::error(__('Something went wrong at the server'));
    }

    public function me()
    {
         return ApiResponse::ok(
            __('My account'),
            new ResourcesUser($this->user()));
    }

    public function settings(Request $request)
    {
        if( $request->isMethod('post') ) {

            $user = $this->user();

            $validator = Validator::make($request->all(), [
                'language' => ['required_without:allow_notification', Rule::in(frontend_languages(true))],
                'allow_notification' => ['required_without:language', Rule::in([0,1])]
            ]);

            if ($validator->fails()) {
                return $this->validation_error_response($validator);
            }

            $user->settings()->updateOrCreate(
                ['user_id' => $user->id],
                $validator->validated()
            );

            return ApiResponse::ok(__('Settings updated'));
        }

        return ApiResponse::ok(__('Settings'), [
            'languages' => frontend_languages()
        ]);
    }
}
