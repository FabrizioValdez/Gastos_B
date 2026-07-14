<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'max:50'],
            'gasto' => ['sometimes', 'numeric', 'min:0'],
            'habilitado' => ['sometimes', 'boolean'],
        ];
    }
}