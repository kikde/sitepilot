<?php

namespace Dapunjabi\CoreAuth\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'coreauth_invites';
    protected $fillable = ['token','tenant_id','role_slug','email','invited_by','accepted_at','expires_at'];
}

