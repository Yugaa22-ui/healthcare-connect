<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Schedule;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $patient = User::where('role', 'patient')->first();
        $doctor = Doctor::first();
        $schedule = Schedule::first();

        if ($patient && $doctor && $schedule) {
            Appointment::create([
                'user_id'          => $patient->id,
                'doctor_id'        => $doctor->id,
                'schedule_id'      => $schedule->id,
                'appointment_date' => now()->addDays(2)->format('Y-m-d'), // Janji temu 2 hari lagi
                'notes'            => 'Konsultasi rutin keluhan pusing.',
                'status'           => 'pending'
            ]);

            Appointment::create([
                'user_id'          => $patient->id,
                'doctor_id'        => $doctor->id,
                'schedule_id'      => $schedule->id,
                'appointment_date' => now()->addDays(5)->format('Y-m-d'),
                'notes'            => 'Cek hasil laboratorium.',
                'status'           => 'completed'
            ]);
        }       
    }
}