<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;
    public function payments()
    {
        return $this->hasMany(StudentPayment::class, 'enrolment_id');
    }
}
