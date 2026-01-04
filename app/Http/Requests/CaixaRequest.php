<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaixaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(){
        return [
            'maquina1' => 'nullable|numeric|min:0',
            'maquina2' => 'nullable|numeric|min:0',
            'maquina3' => 'nullable|numeric|min:0',
            'maquina4' => 'nullable|numeric|min:0',
            'dinheiro' => 'nullable|numeric|min:0',
            'total_taxas' => 'nullable|numeric|min:0',
            'produtos.*' => 'nullable|integer|min:0',
        ];
    }

}
