<?php

namespace Dapunjabi\TenancyAdapter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TenantDomain extends Model
{
    protected $fillable = [
        'tenant_id',
        'domain',
        'verification_token',
        'status',
        'verified',
        'verified_at',
    ];

    protected $casts = [
        'verified' => 'bool',
        'verified_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->verification_token)) {
                $model->verification_token = Str::random(32);
            }
            if (empty($model->status)) {
                $model->status = 'pending';
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function scopeVerified($q)
    {
        return $q->where('status', 'verified');
    }

    public function markVerified(): void
    {
        $this->status = 'verified';
        $this->verified = true;
        $this->verified_at = now();
        $this->save();
    }
}
