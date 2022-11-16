<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarDireccion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'pais'=> "required",
        'estado'=> "required",
        'municipio'=> "required",
        'cp'=> "required",
        'calle'=> "required",
        'numero'=> "required",
        'descripcion'=> "required",
        ];
    }
}
