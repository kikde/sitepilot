<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicket extends Model
{
    // use HasFactory;

    protected $table = 'support_tickets';
    protected $fillable = ['title','via','operating_system','user_agent','description','subject','status','priority','user_id','admin_id','department_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    // public function admin(){
    //     return $this->belongsTo(Admin::class,'admin_id','id');
    // }
    public function department(){
        return $this->belongsTo(TicketDepartment::class,'department_id','id');
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\User\Database\factories\SupportTicketFactory::new();
    // }
}
