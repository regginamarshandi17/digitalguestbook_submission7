<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $students = Mahasiswa::all();
        return response()->json([
            'students' => $students
        ]);
    }
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }
        return response()->json(['data' => $mahasiswa]);
    }
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create([
            'nama'     => $request->input('nama'),
            'jurusan'  => $request->input('jurusan'),
            'angkatan' => $request->input('angkatan'),
        ]);

        return response()->json([
            'message' => 'Mahasiswa berhasil dibuat',
            'student' => $mahasiswa
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->nama    = $request->input('nama');
        $mahasiswa->jurusan = $request->input('jurusan');
        $mahasiswa->angkatan = $request->input('angkatan');
        $mahasiswa->save();

        return response()->json([
            'message' => 'Mahasiswa berhasil diperbarui',
            'student' => $mahasiswa
        ], 200);
    }
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return response()->json([
            'message' => 'Mahasiswa berhasil dihapus'
        ], 200);
    }
}
