<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeluhanPelanggan;
use Illuminate\Routing\Controller;


class KeluhanPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluhan = KeluhanPelanggan::with('statuses')->get();
        return view('frontend.pages.dashboard', compact('keluhan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $keluhan = KeluhanPelanggan::with('statuses')
            ->orderBy('created_at', 'desc') 
            ->get();
        return view('frontend.pages.keluhan_pelanggan.index', compact('keluhan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'nullable|regex:/^[0-9]+$/',
            'keluhan' => 'required|string',
        ], [
            'nama.max' => 'Text too long, maximum 50 characters.',
            'nomor_hp.regex' => 'Input numeric only for Nomor HP.',
        ]);

        $keluhan = KeluhanPelanggan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'status_keluhan' => 0,
            'keluhan' => $request->keluhan,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $keluhan
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keluhan = KeluhanPelanggan::find($id);

        if (!$keluhan) {
            return response()->json(['status' => 'error', 'message' => 'Keluhan tidak ditemukan.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $keluhan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(KeluhanPelanggan $keluhanPelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'nullable|regex:/^[0-9]+$/',
            'keluhan' => 'required|string',
        ], [
            'nama.max' => 'Text too long, maximum 50 characters.',
            'nomor_hp.regex' => 'Input numeric only for Nomor HP.',
        ]);

        $keluhan = KeluhanPelanggan::findOrFail($id);

        $keluhan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'keluhan' => $request->keluhan,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $keluhan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluhan = KeluhanPelanggan::find($id);
        if (!$keluhan) {
            return response()->json(['status' => 'error', 'message' => 'Keluhan tidak ditemukan.'], 404);
        }
        $keluhan->delete();
        return response()->json(['status' => 'success', 'message' => 'Keluhan berhasil dihapus.']);
    }
    
}
