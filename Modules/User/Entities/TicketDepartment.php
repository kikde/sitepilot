<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['name' ,'status'];

    protected $table = "support_ticket_departments";
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\TicketDepartmentFactory::new();
    }
}
