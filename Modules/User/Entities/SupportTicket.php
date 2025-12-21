<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class SupportTicket extends Model
{
    // use HasFactory;

    protected $table = 'support_tickets';
    protected $fillable = ['tenant_id','title','via','operating_system','user_agent','description','subject','status','priority','user_id','admin_id','department_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    // public function admin(){
    //     return $this->belongsTo(Admin::class,'admin_id','id');
    // }
    public function department(){
        return $this->belongsTo(TicketDepartment::class,'department_id','id');
    }

    protected static function booted(): void
    {
        $hasTenantId = null;

        static::addGlobalScope('tenant', function ($q) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('support_tickets', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId) {
                $q->where('tenant_id', (int) $tenantId);
            }
        });

        static::creating(function (self $model) use (&$hasTenantId) {
            if (!function_exists('tenant_id')) return;
            $tenantId = tenant_id();
            if (!$tenantId) return;

            if ($hasTenantId === null) {
                try { $hasTenantId = Schema::hasColumn('support_tickets', 'tenant_id'); } catch (\Throwable $e) { $hasTenantId = false; }
            }
            if ($hasTenantId && empty($model->tenant_id)) {
                $model->tenant_id = (int) $tenantId;
            }
        });
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\User\Database\factories\SupportTicketFactory::new();
    // }
}
