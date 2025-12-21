<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicketMessage extends Model
{
    use HasFactory;

    protected $table = 'support_ticket_messages';
    protected $fillable = ['message','notify','attachment','support_ticket_id','type'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\User\Database\factories\SupportTicketMessageFactory::new();
    // }
}
