<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'document' => ['required', 'file', 'mimes:pdf,doc,docx,xlsx', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El campo title es obligatorio.',
            'description.required' => 'El campo description es obligatorio.',
            'document.required' => 'El campo document es obligatorio.',
            'document.file' => 'El campo document debe ser un archivo.',
            'document.mimes' => 'El documento debe tener un formato de archivo válido (pdf, doc, docx, xlsx).',
            'document.max' => 'El tamaño del documento no debe superar los 2048 kilobytes (2MB).',
        ];
    }
}
