<?php

namespace App\Http\Requests\API;

use App\Models\Property;
use InfyOm\Generator\Request\APIRequest;

class CreatePropertyAPIRequest extends APIRequest
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
        $rules = [
            'title' => 'required',
            'address' => 'required',
            'code' => 'required',
            'status_id' => 'required|integer',
            'property_type_id' => 'required|integer',
            'neighborhood_id' => 'required|integer',
            'user_owner_id' => 'required|integer',
            'status_id' => 'required|integer'
        ];

        // if($this->get('file'))
        //     $rules = array_merge($rules, ['images' => 'array'])
        return $rules;
    }
}
