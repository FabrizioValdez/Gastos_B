<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:50'],
            'password' => ['sometimes', 'string', 'max:50'],
            'gasto' => ['sometimes', 'numeric', 'min:0'],
            'habilitado' => ['sometimes', 'boolean'],
        ];
    }
}