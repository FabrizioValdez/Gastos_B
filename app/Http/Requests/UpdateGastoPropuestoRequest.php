<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateGastoPropuestoRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'categoria' => ['sometimes', 'string', 'max:50'],
            'nombre' => ['sometimes', 'string', 'max:50'],
            'precio_unitario' => ['sometimes', 'numeric', 'min:0'],
            'cantidad' => ['sometimes', 'integer', 'min:0'],
            'votos_positivos' => ['sometimes', 'integer', 'min:0'],
            'votos_negativos' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}