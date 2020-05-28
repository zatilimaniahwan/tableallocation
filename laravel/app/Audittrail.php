<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audittrail extends Model
{
    protected $fillable = [
        'user_id','activity',
    ];
}
