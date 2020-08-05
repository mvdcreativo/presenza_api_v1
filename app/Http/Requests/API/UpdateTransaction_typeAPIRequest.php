<?php

namespace App\Http\Requests\API;

use App\Models\Transaction_type;
use InfyOm\Generator\Request\APIRequest;

class UpdateTransaction_typeAPIRequest extends APIRequest
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
        $rules = Transaction_type::$rules;
        
        return $rules;
    }
}
