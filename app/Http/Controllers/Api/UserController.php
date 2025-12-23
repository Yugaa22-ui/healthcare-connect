<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Menampilkan semua daftar user dengan role patient
     */
    public function index()
    {
        $patients = \App\Models\User::where('role', 'patient')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Pasien Berhasil Diambil',
            'data'    => $patients
        ], 200);
    }

    /**
     * Menampilkan detail satu pasien
     */
    public function show($id)
    {
        $patient = User::where('role', 'patient')->find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $patient
        ], 200);
    }

    /**
     * Menghapus data pasien
     */
    public function destroy($id)
    {
        $patient = User::find($id);

        if (!$patient) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $patient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil dihapus'
        ], 200);
    }
}