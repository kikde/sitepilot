<?php

namespace Dapunjabi\CoreAuth\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'coreauth_roles';
    protected $fillable = ['name', 'slug'];
}

