<?php

namespace Dapunjabi\CoreAuth\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'coreauth_permissions';
    protected $fillable = ['name', 'slug'];
}

