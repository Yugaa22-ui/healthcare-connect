<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        UserSeeder::class,        // Harus pertama (Master Data)
        DoctorSeeder::class,      // Harus sebelum Appointment
        ScheduleSeeder::class,    // Harus sebelum Appointment
        AppointmentSeeder::class, // Taruh di paling bawah
    ]);
}
}
