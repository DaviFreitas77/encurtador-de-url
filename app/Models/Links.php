<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    public $table = 'links';
    public $fillable = ['user_id ','original_url','slug','status','expires_at','click_count'];
    public $timestamps = true;
}
