<?php

namespace Modules\ApiShotWebhook\Entities;

use Illuminate\Database\Eloquent\Model;

class ApishotEvent extends Model
{
    protected $fillable = ['job_id','status','format','result_url','bytes','payload'];
    protected $casts = ['payload' => 'array'];
}
