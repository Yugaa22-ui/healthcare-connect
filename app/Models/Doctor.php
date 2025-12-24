<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'specialist', 
        'phone', 
        'address'
    ];

    public function schedules() 
    {
        return $this->hasMany(Schedule::class);
    }

    // Mendukung fitur Booking kerjaan Dika
    public function appointments() 
    {
        return $this->hasMany(Appointment::class);
    }
}