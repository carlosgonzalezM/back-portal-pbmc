<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBirthdayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string'],
            'last_name' => ['string'],
            'area' => ['string'],
            'date_birthday' => ['date'],
            'image' => ['image', 'mimes:png,jpg, gif, svg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_birthday.date' => 'El campo date_birthday debe ser una fecha válida.',
            'image.image' => 'El archivo de imagen debe ser una imagen válida.',
            'image.mimes' => 'La imagen debe tener un formato de archivo válido (png, jpg, gif, svg).',
            'image.max' => 'La imagen no debe superar los 2048 kilobytes (2MB).',
        ];
    }
}
