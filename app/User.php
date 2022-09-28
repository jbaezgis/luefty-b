<?php

namespace App;
use App\HasRoles;
use App\Country;
use App\Region;
use App\Location;
use App\UserType;
use App\Vehicle;
use willvincent\Rateable\Rateable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, Rateable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password',
        'lang',
        'rating',
        'phone',
        'company_name',
        'country_id',
        'address',
        'country_ispublic',
        'location_id',
        'web_site',
        'rnc',
        'rnc_ispublic',
        'cedula',
        'cedula_ispublic',
        'pseudonym',
        'public',
        'registration_date',
        'next_payment',
        'user_type',
        'email_verified_at',
        'contract',
        'region_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type');
    }

    public function ispublic($query)
    {
        return $query->where('public', 1);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRoles()
    {
        foreach ($roles as $role)
        {
            foreach ($this->$roles as $userRole)
            {
                if ($userRoles->name === $role)
                {
                    return true;
                }
            }
        }
    }

}
