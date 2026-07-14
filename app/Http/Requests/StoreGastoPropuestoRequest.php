<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreGastoPropuestoRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'nombre' => ['required', 'string', 'max:50'],
            'precio_unitario' => ['sometimes', 'numeric', 'min:0'],
            'cantidad' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
