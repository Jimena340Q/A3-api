<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Environment\Environment;

class EnvironmentType extends Model
{
    use HasFactory;
    protected $table = 'environment_type';
    protected $fillable = 
    [
        'description'
    ];

    public function learning_environment()
    {
        return $this->hasMany(LearningEnvironment::class);
    }
}
