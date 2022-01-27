<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classgroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupname',
        'admin',
    ];
    
    public function user()
    {
      return $this->belongsTo(User::class,'admin');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
