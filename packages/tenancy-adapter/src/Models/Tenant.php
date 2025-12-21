<?php

namespace Dapunjabi\TenancyAdapter\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'settings',
        'status',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function domains()
    {
        return $this->hasMany(TenantDomain::class);
    }
}
