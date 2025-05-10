<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Setting extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "phone" => $this->phone,
            "email" => $this->email,
            "fb_link" => $this->fb_link,
            "tw_link" => $this->tw_link,
            "insta_link" => $this->insta_link,
            "watts_link" => $this->watts_link,
            "youtube_link" => $this->youtube_link,

        ];
    }
}
