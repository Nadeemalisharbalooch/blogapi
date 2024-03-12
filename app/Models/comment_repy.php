<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment_repy extends Model
{
    protected $fillable=['comment_id','user_id', 'comment'];
    use HasFactory;
}
