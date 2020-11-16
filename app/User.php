<?php

namespace App;

use App\Models\CampaignCode;
use App\Models\UserCampaignRelation;
use App\Models\UserFavorites;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile_number','profile_url','city','timezone','language','device_system','notification'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function promotionCode()
    {
          return $this->hasOne(UserCampaignRelation::class, 'user_id', 'id');
    }
    public function favorites()
    {
        return $this->hasMany(UserFavorites::class, 'user_id', 'id');
    }
}
