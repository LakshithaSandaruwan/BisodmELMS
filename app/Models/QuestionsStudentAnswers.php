<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsStudentAnswers extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 'quiz_id', 'question_id', 'answer_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(QuestionAnswer::class);
    }
}
