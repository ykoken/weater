<?php

namespace App\Http\Requests\Campaigns;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
          'user_id'       => 'required|unique:user_campaigns,user_id',
          'campaign_code' => 'required|unique:user_campaigns,campaign_code',
        ];


    }
}
