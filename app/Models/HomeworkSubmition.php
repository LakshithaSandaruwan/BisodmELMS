<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkSubmition extends Model
{
    use HasFactory;

    protected $fillable = ['submission_file_path', 'student_id', 'subject_id', 'results'];

    public function homework()
    {
        return $this->belongsTo(Homework::class, 'homework_id', 'id');
    }
}
