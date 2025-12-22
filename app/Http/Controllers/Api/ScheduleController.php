<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Menampilkan semua jadwal beserta data dokternya
    public function index()
    {
        $schedules = Schedule::with('doctor')->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Jadwal Dokter',
            'data'    => $schedules
        ], 200);
    }

    // Menambah jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'  => 'required|exists:doctors,id',
            'day'        => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);

        $schedule = Schedule::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil ditambahkan',
            'data'    => $schedule
        ], 201);
    }

    // Update jadwal
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }

        $schedule->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diperbarui',
            'data'    => $schedule
        ], 200);
    }

    // Hapus jadwal
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }

        $schedule->delete();
        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dihapus'
        ], 200);
    }
}