<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Schedule;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        // Data Dokter 1
        $doc1 = Doctor::create([
            'name' => 'Dr. Andi Wijaya, Sp.A',
            'specialist' => 'Pediatrics (Anak)',
            'phone' => '081122334455',
            'address' => 'Jl. Mawar No. 10, Jakarta'
        ]);

        // Jadwal Dokter 1
        Schedule::create([
            'doctor_id' => $doc1->id,
            'day' => 'Senin',
            'start_time' => '09:00:00',
            'end_time' => '12:00:00'
        ]);

        // Data Dokter 2
        $doc2 = Doctor::create([
            'name' => 'Dr. Siska Pratama, Sp.PD',
            'specialist' => 'Internal Medicine (Penyakit Dalam)',
            'phone' => '085566778899',
            'address' => 'Jl. Melati No. 5, Bandung'
        ]);

        // Jadwal Dokter 2
        Schedule::create([
            'doctor_id' => $doc2->id,
            'day' => 'Selasa',
            'start_time' => '13:00:00',
            'end_time' => '16:00:00'
        ]);
    }
}