<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'image' => ['required', 'image'],
                'document' => ['nullable', 'file', 'mimes:pdf, doc, docx'],
                'paragraphs' => ['required','string']
            ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El campo titulo es obligatorio.',
            'description.required' => 'El campo descripción es obligatorio.',
            'image.required' => 'El campo imagen es obligatorio.',
            'image.image' => 'El archivo de imagen debe ser una imagen válida.',
            'image.mimes' => 'La imagen debe tener un formato de archivo válido (png, jpg, gif, svg).',
            'document.file' => 'El campo documento debe ser un archivo.',
            'document.mimes' => 'El documento debe tener un formato de archivo válido (pdf, doc, docx).',
            'paragraphs' => 'el parrafo es obligatorio'
        ];
    }
}
