<?php

namespace Dapunjabi\CoreAuth\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'coreauth_tenants';
    protected $fillable = ['name', 'slug'];
}

