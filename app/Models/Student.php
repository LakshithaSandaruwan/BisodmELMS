<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'initial', 'LastName', 'FullName', 'Gender', 'birthday',
        'school', 'city', 'grade', 'contactNumber', 'email', 'houseNumber',
        'street', 'district', 'province', 'PerentFullName', 'PerentGender',
        'PerentNic', 'PerentContact', 'PerentEmail','user_id'
    ];
}
