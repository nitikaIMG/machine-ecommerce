<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $profile_pic = $this->profile_pic
            ? storage_url($this->profile_pic)
            : sample_img(200, 200, $this->name ?? '');

       $settings = $this->settings ?? new \App\Models\UserSetting();

        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified' => boolval($this->email_verified_at),
            'phone' => $this->phone,
            'phone_verified' => boolval($this->otp_verified_at),
            'status' => boolval($this->status),
            'onboarded' => boolval($this->onboarded),
            'type' => $this->role,
            'profile_pic' => $profile_pic,
            'settings' => new UserSettingResource($settings),
            'notification_count' =>  countUnreadNotification($this->id),
        ];
    }
}
