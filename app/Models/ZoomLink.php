<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomLink extends Model
{
    use HasFactory;

    public function subjectMapping()
    {
        return $this->belongsTo(SubjectMapping::class);
    }
}
