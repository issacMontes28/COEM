<?php

namespace COEM\Http\Requests;

use COEM\Http\Requests\Request;

class PacientCreateRequest extends Request
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
          'apaterno'=>'required',
          'amaterno'=>'required',
          'fecha_nac'=>'required',
          'calle'=>'required',
          'colonia'=>'required',
          'municipio'=>'required',
          'estado'=>'required',
          'fecha_inicio'=>'required',
        ];
    }
}
