<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['karyawans'] = Karyawan::all();
        return view('index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'nama_karyawan' => 'required|unique:karyawans,nama_karyawan',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'foto' => 'required',
                'status_perkawinan' => 'required',
            ]);

            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image->storeAs('public/foto-karyawan', $image->hashName());
                $request->foto = $image->hashName();
            }

            Karyawan::create([
                'nama_karyawan' => $request->nama_karyawan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'foto' => $request->foto,
                'status_perkawinan' => $request->status_perkawinan == 'true' ? true : false
            ]);

            DB::commit();
            return redirect()->route('karyawan.index')->with('success', 'Berhasil membuat data karyawan');
        } catch (ValidationException $th) {
            DB::rollBack();
            return back()->withErrors($th->validator?->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('edit', ['karyawan' => $karyawan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'nama_karyawan' => 'nullable',
                'tanggal_lahir' => 'nullable',
                'alamat' => 'nullable',
                'foto' => 'nullable',
                'status_perkawinan' => 'nullable',
            ]);

            if ($request->hasFile('foto')) {
                if (Storage::exists('public/foto-karyawan/' . $karyawan->foto)) {
                    Storage::delete('public/foto-karyawan/' . $karyawan->foto);
                }
                $image = $request->file('foto');
                $image->storeAs('public/foto-karyawan', $image->hashName());
                $request->foto = $image->hashName();
            } else {
                $request->foto = $karyawan->foto;
            }

            $karyawan->update([
                'nama_karyawan' => $request->nama_karyawan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'foto' => $request->foto,
                'status_perkawinan' => $request->status_perkawinan == 'true' ? true : false
            ]);

            DB::commit();
            return redirect()->route('karyawan.index')->with('success', 'Berhasil mengupdate data karyawan');
        } catch (ValidationException $th) {
            DB::rollBack();
            return back()->withErrors($th->validator?->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        try {
            DB::beginTransaction();
            $karyawan->delete();
            DB::commit();
            return redirect()->route('karyawan.index')->with('success', 'Berhasil menghapus data karyawan');
        } catch (ValidationException $th) {
            DB::rollBack();
            return back()->withErrors($th->validator?->errors())->withInput();
        }
    }
}
