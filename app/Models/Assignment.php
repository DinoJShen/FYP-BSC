<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'createdby',
        'group_id',
        'dueDate',
        'file_name',
        'file_path',
    ];

    public function user()
    {
      return $this->belongsTo(User::class,'created_by');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function group()
    {
        return $this->belongsTo(Classgroup::class,'group_id');
    }
}
