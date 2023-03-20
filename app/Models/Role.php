<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //role permission relationships
    public function permissions() {

        return $this->belongsToMany(Permission::class);

     }

     //user role_as relationship
     public function users(){
        return $this->belongsToMany(User::class);
     }
}
