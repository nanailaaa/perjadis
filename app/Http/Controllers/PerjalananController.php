<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TPerjalanan;
use App\Models\RincianModel;
use App\Models\User;
use App\Models\MTimModel;
use App\Models\MJenisTransport;

class PerjalananController extends Controller
{
    public function index()
    {
        $data = TPerjalanan::with('user')->latest()->paginate(10);
        $users = User::all();
        $tim = MTimModel::all();
        $transport = MjenisTransport::all();

        return view('perjalanan.perjalanan', compact('data', 'users', 'tim', 'transport'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'no_surat' => 'required',
            'tujuan' => 'required',
            'tgl_berangkat' => 'required|date',
            'tgl_pulang' => 'required|date',
            'hari' => 'required|numeric',
            'foto_surat' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload surat tugas
        $fotoSuratPath = $request->file('foto_surat')->store('surat', 'public');

        // Simpan perjalanan
        $perjalanan = TPerjalanan::create([
            'user_id' => $request->user_id,
            'tim_penanggung_jawab' => $request->tim_penanggung_jawab,
            'no_surat' => $request->no_surat,
            'tujuan' => $request->tujuan,
            'tgl_berangkat' => $request->tgl_berangkat,
            'tgl_pulang' => $request->tgl_pulang,
            'hari' => $request->hari,
            'foto_surat' => $fotoSuratPath,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
        ]);

        // Upload bukti transaksi (foto rincian)
        $fotoPaths = [];
        if ($request->hasFile('foto_rincian')) {
            foreach ($request->file('foto_rincian') as $foto) {
                $path = $foto->store('rincian', 'public');
                $fotoPaths[] = $path;
            }
        }

        // Simpan rincian biaya
        RincianModel::create([
            'perjalanan_id' => $perjalanan->id,
            'user_id' => Auth::id(),
            'biaya_ke_bandara' => $request->biaya_ke_bandara ?? 0,
            'biaya_berangkat' => $request->biaya_berangkat ?? 0,
            'biaya_pulang' => $request->biaya_pulang ?? 0,
            'biaya_hotel' => $request->biaya_hotel ?? 0,
            'biaya_uh' => $request->biaya_uh ?? 0,
            'total_biaya' =>
                ($request->biaya_ke_bandara ?? 0) +
                ($request->biaya_berangkat ?? 0) +
                ($request->biaya_pulang ?? 0) +
                ($request->biaya_hotel ?? 0) +
                ($request->biaya_uh ?? 0),
            'foto_rincian' => json_encode($fotoPaths),
            'no_bangku' => $request->no_kursi_berangkat ?? null,
            'jenis_transport_berangkat' => $request->jenis_transport_berangkat,
            'jenis_transport_pulang' => $request->jenis_transport_pulang,
            'jenis_transport_bandara' => $request->jenis_transport_bandara,
        ]);

        return back()->with('success', 'Perjalanan dan rincian biaya berhasil disimpan!');
    }

    public function destroy($id)
    {
        $perjalanan = TPerjalanan::findOrFail($id);
        $perjalanan->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}
