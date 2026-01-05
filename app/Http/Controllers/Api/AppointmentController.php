<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Fungsi untuk membuat janji temu baru (Booking)
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'schedule_id' => 'required|exists:schedules,id',
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

        // Cek apakah pasien ini sudah booking dokter yang sama di jadwal yang sama
        $isBooked = Appointment::where('schedule_id', $request->schedule_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('user_id', Auth::id())
            ->exists();

        if ($isBooked) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memiliki janji temu di jadwal ini.'
            ], 422);
        }

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'schedule_id' => $request->schedule_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending', // Status awal otomatis pending
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Janji temu berhasil dibuat!',
            'data' => $appointment
        ], 201);
    }

    // Fungsi melihat daftar janji temu milik saya (Pasien)
  public function index()
    {
        // Jika ingin melihat SEMUA data (untuk keperluan testing/admin)
        $appointments = Appointment::with(['doctor', 'schedule'])->get();

        // JIKA ingin filter per user, pastikan login dengan akun yang punya data
        // $appointments = Appointment::with(['doctor', 'schedule'])->where('user_id', Auth::id())->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar janji temu berhasil diambil',
            'data' => $appointments
        ]);
    }
}