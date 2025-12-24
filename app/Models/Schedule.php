<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 
        'day', 
        'start_time', 
        'end_time'
    ];

    // Relasi ke Dokter
    public function doctor() 
    {
        return $this->belongsTo(Doctor::class);
    }

    // Agar sistem Appointment Dika bisa melacak jadwal
    public function appointments() 
    {
        return $this->hasMany(Appointment::class);
    }
}