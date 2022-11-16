<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarProductoRequest extends FormRequest
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
            "producto" => "required",
            "cantidad" => "required",
            "precio_c" => "required",
            "precio_v" => "required",
            "imagePath" => "required",
            "descripcion" => "required"

        ];
    }
}
