<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $fillable = ['file_path', 'deadline', 'subject_id'];

    public function submissions()
    {
        return $this->hasMany(HomeworkSubmition::class, 'homework_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectMapping::class, 'subject_id');
    }
}
