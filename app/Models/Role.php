<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
protected $primaryKey = 'id';

    public function permissions()

    {
 
        return $this->belongsToMany(Permissions::class,'roles_permissions','role_id','permission_id');

    }
      

       public function hasPermission( Permissions $permission )
    {
        return $this->permissions->contains( $permission );
    }
  
 public function users()
    {
        return $this->belongsToMany(User::class,'users_roles', 'role_id', 'user_id');
    }
    


    
}