<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Doctor;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dokter pertama yang ada di database
        $doctor = Doctor::first();

        if ($doctor) {
            $days = ['Monday', 'Wednesday', 'Friday'];
            
            foreach ($days as $day) {
                Schedule::create([
                    'doctor_id'  => $doctor->id,
                    'day'        => $day,
                    'start_time' => '09:00:00',
                    'end_time'   => '12:00:00',
                ]);
            }
        }
    }
}