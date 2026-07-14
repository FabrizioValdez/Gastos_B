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
            'categoria_id' => ['sometimes', 'integer', 'exists:categorias,id'],
            'nombre' => ['sometimes', 'string', 'max:50'],
            'precio_unitario' => ['sometimes', 'numeric', 'min:0'],
            'cantidad' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
