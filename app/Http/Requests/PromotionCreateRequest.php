<?php

namespace COEM\Http\Requests;

use COEM\Http\Requests\Request;

class PromotionCreateRequest extends Request
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
          'tipo'=>'required'
        ];
    }
}
