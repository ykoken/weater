<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Set this to true if you want to authorize the validation
        // The default is false
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return  [
            'name' => 'required',
            'email' => 'required|email|unique:member,email',
            'file' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mobile_number' => [
                'nullable',
                'string',
                'min:10',
                'max:10',
                'regex:/^5/',
                'unique:users,mobile_number',
            ],
        ];


    }
}
