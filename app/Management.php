<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $fillable = [
        'name', 'resource', 'index_id'
    ];
}
