<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'document' => $this->document,
            'paragraphs' => $this->paragraphs, // Agregar los párrafos
            'created_at' => $this->created_at->format('Y-m-d')
        ];

    }
}
