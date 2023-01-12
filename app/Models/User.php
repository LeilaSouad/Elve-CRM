<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRolesAndPermissions;




class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndPermissions;
    protected $primaryKey = 'id';
     protected $guard = 'admin';


 public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles', 'user_id', 'role_id');
    }

public function hasRole( Role $role )
    {
        return $this->roles->contains( $role );
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
