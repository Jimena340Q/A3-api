<?php

namespace Database\Seeders;

use App\Models\SchedulingEnvironment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulingEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchedulingEnvironment::insert([
            ['course_id' => 1 , 'instructor_id' => 2, 'date_scheduling' => '2024-02-20', 
                'initial_hour' => '11:13:00' , 'final_hour' => '12:10:00' , 'environment_id' => 1],
        ]);
    }
}
