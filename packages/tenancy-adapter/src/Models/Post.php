<?php

namespace Dapunjabi\TenancyAdapter\Models;

use Illuminate\Database\Eloquent\Model;
use Dapunjabi\TenancyAdapter\Models\Concerns\BelongsToTenant;

class Post extends Model
{
    use BelongsToTenant;

    protected $table = 'tenant_posts';

    protected $fillable = [
        'tenant_id',
        'title',
        'body',
    ];
}
