<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use App\Models\UserAccessLevel;
use App\Models\UsersTypes;
use App\Models\TypesOfUsers;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function accessLevels()
    {
        return $this->belongsToMany(AccessLevel::class, 'access_level_user');
    }

    public function accessibleMenus()
    {
        return Menu::whereHas('accessLevels', function($query) {
            $query->whereIn('access_levels.id', $this->accessLevels->pluck('id'));
        })->get();
    }

    public function userTypes()
    {
        return $this->belongsToMany(TypesOfUsers::class, 'users_types', 'user_id', 'type_of_user_id');
    }


    public function getJWTidentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function enderecos()
    {
        return $this->morphMany(Endereco::class, 'addressable');
    }

}
