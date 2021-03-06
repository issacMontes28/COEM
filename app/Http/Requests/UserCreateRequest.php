<?php

namespace COEM\Http\Requests;

use COEM\Http\Requests\Request;

class UserCreateRequest extends Request
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
            'apellidos'=>'required',
            'correo'=>'required' ,
            'tipo_usuario'=>'required',
            'password'=>'required'
        ];
    }
}
