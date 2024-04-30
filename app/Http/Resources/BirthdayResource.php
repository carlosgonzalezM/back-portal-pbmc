<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BirthdayResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'image' => $this->image,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'area' => $this->area,
            'date_birthday' => $this->date_birthday,
        ];
    }
}
