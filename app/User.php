<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_name','slug'
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



    ///RELATIONSHIP


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function account()
    {
        return $this->hasOne(\App\Models\Account::class);
    }

    public function expenses_properties_user()
    {
        return $this->hasMany(\App\Models\ExpensesPropertiesUsers::class);
        
    }

    public function properties_owner()
    {
        return $this->hasMany(\App\Models\Property::class,'user_owner_id');
    }
    


    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)

       

            $result = $query->whereHas('account', function($q) use($filter) {
                        $q
                        ->where('role', $filter)
                        ->orWhere('address', "LIKE", '%'.$filter.'%')
                        ->orWhere('phone', "LIKE", '%'.$filter.'%')
                        ->orWhere('movil', "LIKE", '%'.$filter.'%')
                        ->orWhere('dni', "LIKE", '%'.$filter.'%')
                        ->orWhere('cuit', "LIKE", '%'.$filter.'%')
                        ->orWhere('company', "LIKE", '%'.$filter.'%');
                    });
            $result ->orWhere('name', "LIKE", '%'.$filter.'%')
                    ->orWhere('email', "LIKE", '%'.$filter.'%');
            
            return $result;


    }
}
