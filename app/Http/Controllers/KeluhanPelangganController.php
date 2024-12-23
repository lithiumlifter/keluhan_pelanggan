<?php

namespace App\Http\Controllers;

use App\Models\KeluhanPelanggan;
use Illuminate\Http\Request;

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
        return response()->json($keluhan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(KeluhanPelanggan $keluhanPelanggan)
    {
        //
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
    public function update(Request $request, KeluhanPelanggan $keluhanPelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeluhanPelanggan  $keluhanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeluhanPelanggan $keluhanPelanggan)
    {
        //
    }
}
