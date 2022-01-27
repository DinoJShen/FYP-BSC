<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'rate',
    ];

    protected $table = 'feedbacks';

    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }
}
