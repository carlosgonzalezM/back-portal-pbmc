<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
            'title' => ['string'],
            'description' => ['string'],
            'image' => ['mimes:png,jpg, gif, svg'],
            'document' => ['mimes:pdf, doc, docx'],
            'paragraphs' => ['string'],
        ];
    }

    public function messages(){
        return [
            'image.mimes' => 'La imagen debe tener un formato de archivo válido (png, jpg, gif, svg).',
            'document.mimes' => 'El documento debe tener un formato de archivo válido (pdf, doc, docx).',
        ];
    }


}
