<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;
    public function subjectMappings()
    {
        return $this->hasMany(SubjectMapping::class);
    }

    // Method to calculate total number of students
    // public function calculateTotalStudents()
    // {
    //     $totalStudents = 0;

    //     foreach ($this->subjectMappings as $subjectMapping) {
    //         $totalStudents += $subjectMapping->enrollments()->count();
    //     }

    //     return $totalStudents;
    // }

    public function calculateTotalStudents()
    {
        $totalStudents = 0;

        foreach ($this->subjectMappings as $subjectMapping) {
            foreach ($subjectMapping->enrollments as $enrollment) {
                $lastPayment = $enrollment->payments()->latest('payment_date')->first();
                if ($lastPayment) {
                    $lastPaymentDate = Carbon::parse($lastPayment->payment_date);
                    if ($lastPaymentDate->greaterThanOrEqualTo(Carbon::now()->subDays(35))) {
                        $totalStudents++;
                    }
                }
            }
        }

        return $totalStudents;
    }

    public function hasPayments()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        return $this->payments()->where('month', 'like', "$currentMonth%")->exists();
    }

    public function payments()
    {
        return $this->hasMany(TeacherPayment::class, 'teacher_id');
    }

}
