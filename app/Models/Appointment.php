<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // 1. Agar data booking bisa masuk lewat controller
    protected $fillable = [
        'user_id',
        'doctor_id',
        'schedule_id',
        'appointment_date',
        'notes',
        'status'
    ];

    // 2. Relasi ke Pasien (User) yang melakukan booking
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 3. Relasi ke Dokter yang dipilih
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // 4. Relasi ke Jadwal yang dipilih
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}