<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable=['user_id','category_id','title','description','image','status','tags'];
    public $timestamps=false;
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function category(){
        return  $this->belongsTo(category::class);
    }
    public function user(){
        return  $this->belongsTo(user::class);
    }
    public function gallery(){
        return  $this->belongsTo(gallery::class);
    }
    public function comments(){
        return  $this->belongsTo(comments::class);
    }
}
