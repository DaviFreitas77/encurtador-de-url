<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    public $table = 'visits';
    public $fillable = ['link_id','ip_hash ','user_agent','created_at'];
    public $timestamps = false;
}
