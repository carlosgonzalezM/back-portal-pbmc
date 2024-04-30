<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBirthdayRequest extends FormRequest
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
            'user_id' => [ 'required', 'numeric'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'area' => ['required', 'string'],
            'date_birthday' => ['required', 'date'],
            'image' => ['nullable', 'image', 'mimes:png,jpg, gif, svg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_birthday.date' => 'El campo date_birthday debe ser una fecha válida.',
        ];
    }
}
