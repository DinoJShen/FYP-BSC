<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $fillable = [
        'assignment_id', 
        'upload_from',
        'file_name',
        'file_path',
    ];

    public function user()
    {
      return $this->belongsTo(User::class,'upload_from');
    }

    public function assignment()
    {
      return $this->belongsTo(Assignment::class);
    }
}
