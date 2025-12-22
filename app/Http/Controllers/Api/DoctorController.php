<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Lihat Semua Dokter
    public function index()
    {
        $doctors = Doctor::with('schedules')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Dokter',
            'data'    => $doctors
        ], 200);
    }

    // Tambah Dokter Baru
    public function store(Request $request)
    {
        $doctor = Doctor::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Dokter Berhasil Ditambahkan',
            'data'    => $doctor
        ], 201);
    }

    // Lihat Detail Satu Dokter
    public function show($id)
    {
        $doctor = Doctor::with('schedules')->find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }
        return response()->json(['success' => true, 'data' => $doctor], 200);
    }

    // Update Data Dokter
    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }
        $doctor->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data Diperbarui', 'data' => $doctor], 200);
    }

    // Hapus Dokter
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }
        $doctor->delete();
        return response()->json(['success' => true, 'message' => 'Dokter Berhasil Dihapus'], 200);
    }
}