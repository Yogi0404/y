<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CKaryawan extends Controller
{
    private $response=[
        'message'=>null,
        'data'=>null
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Karyawan=karyawan::all();
        return response()->json(['Karyawan' => $Karyawan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
   
    
       public function store(Request $request)
    {
        
        // Validasi request
        $request->validate([
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
            'password' => 'required',
        ]);

        // Buat user baru
        $karyawan = new karyawan();
        $karyawan->nik = $request->nik;
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->password = bcrypt($request->password); // Encrypt password

        // Simpan user ke dalam database
        $karyawan->save();

        // Berikan respons sesuai kebutuhan Anda, misalnya:
        return response()->json(['message' => 'User berhasil disimpan'], 201);
    }
    
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
