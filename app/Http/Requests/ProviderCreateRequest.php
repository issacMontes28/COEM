<?php

namespace COEM\Http\Requests;

use COEM\Http\Requests\Request;

class ProviderCreateRequest extends Request
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
          'nombre'=>'required',
          'nombre_encargado'=>'required',
          'apellidos'=>'required',
          'telefono_celular'=>'required'
        ];
    }
}
