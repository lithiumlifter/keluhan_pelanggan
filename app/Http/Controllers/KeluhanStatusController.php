<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeluhanPelanggan;
use App\Models\KeluhanStatusHis;
use Illuminate\Support\Facades\Validator;

class KeluhanStatusController extends Controller
{
    public function updateStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status_keluhan' => 'required|in:0,1,2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $keluhan = KeluhanPelanggan::find($id);

        if (!$keluhan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Keluhan tidak ditemukan!'
            ], 404);
        }

        $keluhan->status_keluhan = $request->status_keluhan;
        $keluhan->save();

        KeluhanStatusHis::create([
            'keluhan_id' => $keluhan->id,
            'status_keluhan' => $request->status_keluhan,
            'updated_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status keluhan berhasil diupdate!',
            'data' => $keluhan
        ], 200);
    }

    public function deleteStatus($id)
    {
        $keluhan = KeluhanPelanggan::find($id);

        if (!$keluhan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Keluhan tidak ditemukan!'
            ], 404);
        }

        KeluhanStatusHis::where('keluhan_id', $keluhan->id)->delete();

        $keluhan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Keluhan dan statusnya berhasil dihapus!'
        ], 200);
    }
}
