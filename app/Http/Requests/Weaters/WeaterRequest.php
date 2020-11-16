<?php

namespace App\Http\Requests\Weaters;

use Illuminate\Foundation\Http\FormRequest;

class WeaterRequest extends FormRequest
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
          'user_id'       => 'required',
          'city_id'       => 'required',
        ];


    }
}
