<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\KeluhanPelanggan;
use App\Models\KeluhanStatusHis;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KeluhanPelangganExport;
use App\Http\Requests\KeluhanPelangganRequest;

class KeluhanPelangganController extends Controller
{
    public function index()
    {
        $receivedCount = KeluhanPelanggan::where('status_keluhan', 0)->count();
        $inProcessCount = KeluhanPelanggan::where('status_keluhan', 1)->count();
        $doneCount = KeluhanPelanggan::where('status_keluhan', 2)->count();
    
        $totalKeluhan = $receivedCount + $inProcessCount + $doneCount;
    
        $receivedPercentage = $totalKeluhan > 0 ? ($receivedCount / $totalKeluhan) * 100 : 0;
        $inProcessPercentage = $totalKeluhan > 0 ? ($inProcessCount / $totalKeluhan) * 100 : 0;
        $donePercentage = $totalKeluhan > 0 ? ($doneCount / $totalKeluhan) * 100 : 0;
    
        $keluhanPerMonth = KeluhanPelanggan::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, status_keluhan, count(*) as count')
            ->groupByRaw('MONTH(created_at), YEAR(created_at), status_keluhan')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    
        $receivedCounts = [];
        $inProcessCounts = [];
        $doneCounts = [];
        $months = [];
    
        foreach ($keluhanPerMonth as $keluhan) {
            $month = $keluhan->month . '-' . $keluhan->year;
            $months[] = $month;
    
            if ($keluhan->status_keluhan == 0) {
                $receivedCounts[] = $keluhan->count;
            } elseif ($keluhan->status_keluhan == 1) {
                $inProcessCounts[] = $keluhan->count;
            } elseif ($keluhan->status_keluhan == 2) { 
                $doneCounts[] = $keluhan->count;
            }
        }

        $keluhan = KeluhanPelanggan::all()->map(function($keluhan) {
            $keluhan->umur_keluhan = Carbon::parse($keluhan->created_at)->diffInDays(Carbon::now());
            return $keluhan;
        })->sortByDesc('umur_keluhan')->take(10);
    
        return view('frontend.pages.dashboard', compact(
            'keluhan', 'receivedCount', 'inProcessCount', 'doneCount',
            'receivedPercentage', 'inProcessPercentage', 'donePercentage', 
            'receivedCounts', 'inProcessCounts', 'doneCounts', 'months'
        ));
    }
    
    public function create(Request $request)
    {
        $keluhan = KeluhanPelanggan::with('statuses')
            ->orderBy('created_at', 'desc') 
            ->get();
        return view('frontend.pages.keluhan_pelanggan.index', compact('keluhan'));
    }

    public function store(KeluhanPelangganRequest $request)
    {
        $keluhan = KeluhanPelanggan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'status_keluhan' => 0,
            'keluhan' => $request->keluhan,
        ]);

        KeluhanStatusHis::create([
            'keluhan_id' => $keluhan->id,
            'status_keluhan' => 0,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $keluhan
        ]);
    }

    public function show($id)
    {
        $keluhan = KeluhanPelanggan::find($id);

        if (!$keluhan) {
            return response()->json(['status' => 'error', 'message' => 'Keluhan tidak ditemukan.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $keluhan]);
    }

    public function history($id)
    {
        $keluhan = KeluhanPelanggan::find($id);
        
        if (!$keluhan) {
            return response()->json(['status' => 'error', 'message' => 'Keluhan tidak ditemukan.']);
        }
    
        $history = KeluhanStatusHis::where('keluhan_id', $id)
                                    ->orderBy('updated_at', 'asc')
                                    ->get();
    
        $timeline = [
            'initial_status' => $keluhan->status_keluhan,
            'created_at' => $keluhan->created_at,
            'history' => $history
        ];
    
        return response()->json([
            'status' => 'success',
            'data' => $timeline
        ]);
    }

    public function update(KeluhanPelangganRequest $request,$id)
    {
        $keluhan = KeluhanPelanggan::findOrFail($id);

        KeluhanStatusHis::create([
            'keluhan_id' => $keluhan->id,
            'status_keluhan' => $keluhan->status_keluhan,
            'updated_at' => Carbon::now(),
        ]);

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

    public function destroy($id)
    {
        $keluhan = KeluhanPelanggan::find($id);
        if (!$keluhan) {
            return response()->json(['status' => 'error', 'message' => 'Keluhan tidak ditemukan.'], 404);
        }
        $keluhan->delete();
        return response()->json(['status' => 'success', 'message' => 'Keluhan berhasil dihapus.']);
    }

    public function export($format)
    {
        if ($format == 'csv') {
            return Excel::download(new KeluhanPelangganExport, 'keluhan_pelanggan.csv');
        }

        if ($format == 'xls') {
            return Excel::download(new KeluhanPelangganExport, 'keluhan_pelanggan.xlsx');
        }

        if ($format == 'txt') {
            $keluhan = KeluhanPelanggan::all();
            $fileContent = "ID\tNama\tEmail\tStatus Keluhan\tCreated At\tUpdated At\n";
            foreach ($keluhan as $item) {
                $fileContent .= "{$item->id}\t{$item->nama}\t{$item->email}\t{$item->status_keluhan}\t{$item->created_at}\t{$item->updated_at}\n";
            }

            return response($fileContent)
                    ->header('Content-Type', 'text/plain')
                    ->header('Content-Disposition', 'attachment; filename="keluhan_pelanggan.txt"');
        }

        if ($format == 'pdf') {
            $keluhan = KeluhanPelanggan::all();
            $htmlContent = view('exports.keluhan_pdf', compact('keluhan'))->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($htmlContent);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            return $dompdf->stream('keluhan_pelanggan.pdf');
        }

        return response()->json(['message' => 'Format not supported'], 400);
    }
    
}
