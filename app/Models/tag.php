<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public $timestamps=false;
    // Tag.php (Model)

public function posts()
{
  
    return $this->belongsToMany(Post::class);
}

}

