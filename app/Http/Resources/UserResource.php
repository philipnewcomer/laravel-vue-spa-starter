<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var $this User */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'verified' => ! empty($this->email_verified_at)
        ];
    }
}
