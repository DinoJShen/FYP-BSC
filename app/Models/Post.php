<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'detail',
        'createdby',
        'group_id',
    ];

    public function classgroup()
    {
      return $this->belongsTo(Classgroup::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class,'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
