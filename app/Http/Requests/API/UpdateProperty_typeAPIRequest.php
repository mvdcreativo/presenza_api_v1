<?php

namespace App\Http\Requests\API;

use App\Models\Property_type;
use InfyOm\Generator\Request\APIRequest;

class UpdateProperty_typeAPIRequest extends APIRequest
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
        $rules = Property_type::$rules;
        
        return $rules;
    }
}
