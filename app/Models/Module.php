<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
      
    ];

    // Relation: Module belongs to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relation: Module has many contents
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
