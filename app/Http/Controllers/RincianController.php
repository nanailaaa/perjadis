<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RincianModel;
use App\Models\TPerjalanan;
use App\Models\MJenisTransport;
use Illuminate\Support\Facades\Auth;

class RincianController extends Controller
{
    /**
     * Menampilkan rincian biaya dari satu perjalanan
     */
    public function show($perjalanan_id)
    {
        $perjalanan = TPerjalanan::with(['user', 'rincian'])->findOrFail($perjalanan_id);
        $transport = MJenisTransport::all();

        return view('perjalanan.Rshow', compact('perjalanan', 'transport'));
    }

    /**
     * Simpan rincian biaya perjalanan
     */
    public function store(Request $request)
    {
        $request->validate([
            'perjalanan_id' => 'required|exists:t_perjalanan,id',
            'biaya_ke_bandara' => 'required|numeric',
            'biaya_berangkat' => 'required|numeric',
            'biaya_pulang' => 'required|numeric',
            'biaya_hotel' => 'required|numeric',
            'biaya_uh' => 'required|numeric',
            'foto_rincian' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'jenis_transport_berangkat' => 'required|exists:m_jenis_transport,id',
            'jenis_transport_pulang' => 'required|exists:m_jenis_transport,id',
            'jenis_transport_bandara' => 'nullable|exists:m_jenis_transport,id',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_rincian')) {
            $fotoPath = $request->file('foto_rincian')->store('rincian', 'public');
        }

        RincianModel::create([
            'perjalanan_id' => $request->perjalanan_id,
            'user_id' => Auth::id(),
            'biaya_ke_bandara' => $request->biaya_ke_bandara,
            'biaya_berangkat' => $request->biaya_berangkat,
            'biaya_pulang' => $request->biaya_pulang,
            'biaya_hotel' => $request->biaya_hotel,
            'biaya_uh' => $request->biaya_uh,
            'total_biaya' =>
                $request->biaya_ke_bandara +
                $request->biaya_berangkat +
                $request->biaya_pulang +
                $request->biaya_hotel +
                $request->biaya_uh,
            'foto_rincian' => $fotoPath,
            'no_bangku' => $request->no_bangku ?? null,
            'jenis_transport_berangkat' => $request->jenis_transport_berangkat,
            'jenis_transport_pulang' => $request->jenis_transport_pulang,
            'jenis_transport_bandara' => $request->jenis_transport_bandara,
        ]);

        return redirect()
            ->route('rincian.show', $request->perjalanan_id)
            ->with('success', 'Rincian perjalanan berhasil disimpan.');
    }
}
