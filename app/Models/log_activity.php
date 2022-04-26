<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_activity extends Model
{
    protected $table = 'log_activity';
    protected $primaryKey = 'id_log';
    protected $fillable = ['activity', 'id_actor','id_object'];
}