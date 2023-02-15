<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use App\Http\Resources\UserAddressResource;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiResponse::ok(
            __('Address list'),
            UserAddressResource::collection($this->user()->addresses)
        );
    }

    public function show(Request $request)
    {
        $user = $this->user();

        $request->validate(
            ['address_id' => ['required', 'exists:user_addresses,id,user_id,'.$user->id]],
            ['address_id.exists' => __('Resource does not exist')]
        );

        $address = $this->user()->addresses()->find($request->get('address_id'));

        return ApiResponse::ok(__('Added'), new UserAddressResource($address));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->user();

        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email', 'max:191', 'unique:user_addresses,email,'.$user->id.',user_id'],
            'phone' => ['nullable', 'digits_between:8,12', 'unique:user_addresses,phone,'.$user->id.',user_id'],
            'address_1' => ['nullable', 'string', 'max:191'],
            'address_2' => ['nullable', 'string', 'max:191'],
            'country' => ['nullable', 'string', 'max:191'],
            'state' => ['nullable', 'string', 'max:191'],
            'city' => ['nullable', 'string', 'max:191'],
            'zip' => ['nullable', 'string', 'max:100'],
            'is_primary' => ['nullable', 'in:1'],
            'latitude' => ['nullable', 'max:191', 'lat_long'],
            'longitude' => ['nullable', 'max:191', 'lat_long']
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        $address = $this->user()->addresses()->create( $validator->validated() );

        // set other addresses as secondary
        if( $request->get('is_primary') ) {
            $this->user()->addresses()
                ->where('id', '<>', $address->id)
                ->update(['is_primary' => 0]);
        }

        return ApiResponse::ok(__('Added'), new UserAddressResource($address));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $this->user();

        $validator = Validator::make($request->all(), [
            'address_id' => ['required', 'exists:user_addresses,id,user_id,'.$user->id],
            'name' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email', 'max:191', 'unique:user_addresses,email,'.$user->id.',user_id'],
            'phone' => ['nullable', 'digits_between:8,12', 'unique:user_addresses,phone,'.$user->id.',user_id'],
            'address_1' => ['nullable', 'string', 'max:191'],
            'address_2' => ['nullable', 'string', 'max:191'],
            'country' => ['nullable', 'string', 'max:191'],
            'state' => ['nullable', 'string', 'max:191'],
            'city' => ['nullable', 'string', 'max:191'],
            'zip' => ['nullable', 'string', 'max:100'],
            'is_primary' => ['nullable', 'in:1'],
            'latitude' => ['nullable', 'max:191', 'lat_long'],
            'longitude' => ['nullable', 'max:191', 'lat_long']
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        $address = $this->user()->addresses()->find($request->get('address_id'));

        $address->fill($validator->validated());
        $address->update();

        // set other addresses as secondary
        if( $request->get('is_primary') ) {
            $this->user()->addresses()
                ->where('id', '<>', $request->get('address_id'))
                ->update(['is_primary' => 0]);
        }

        return ApiResponse::ok(__('Updated'), new UserAddressResource($address));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = $this->user();

        $request->validate(
            ['address_id' => ['required', 'exists:user_addresses,id,user_id,'.$user->id]],
            ['address_id.exists' => __('Resource does not exist')]
        );

        $this->user()->addresses()
            ->where('id', $request->get('address_id'))
            ->delete();

        return ApiResponse::ok(__('Deleted'));
    }
}
