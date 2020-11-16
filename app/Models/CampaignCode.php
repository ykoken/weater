<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignCode extends Model
{
    protected $table = "campaign_codes";
    public $timestamps = false;
    protected $fillable =[
        'name',
        'start_date',
        'end_date',
        'status'
    ];
}
