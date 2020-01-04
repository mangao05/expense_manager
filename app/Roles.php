<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
