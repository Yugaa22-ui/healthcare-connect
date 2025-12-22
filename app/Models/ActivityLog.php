<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    // Tambahkan baris ini agar kolom bisa diisi
    protected $fillable = [
        'user_id', 
        'action', 
        'description', 
        'ip_address'
    ];

    // Relasi ke User (Opsional tapi bagus untuk ada)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}