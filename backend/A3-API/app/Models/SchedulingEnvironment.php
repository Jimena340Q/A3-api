<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulingEnvironment extends Model
{
    use HasFactory;
    protected $table = 'scheduling_environment';
    protected $fillable = 
    [
        'course_id',
        'instructor_id',
        'date_scheduling',
        'initial_hour',
        'final_hour',
        'environment_id'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
    public function learning_environment()
    {
        return $this->belongsTo(LearningEnvironment::class, 'environment_id');
    }
}
