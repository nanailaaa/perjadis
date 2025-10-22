<?php

namespace App\Http\Controllers;

use App\Models\MPegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * (Tambah & Edit Pegawai)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nip' => 'required'
        ]);


        // Cek apakah ID dikirim (artinya edit)
        if ($request->id != "") {
            $store = MPegawai::where('id', $request->id)->update([
                'nama_pegawai' => $request->nama_pegawai,
                'nip' => $request->nip,
            ]);
        } else {
            $store = MPegawai::create([
                'nama_pegawai' => $request->nama_pegawai,
                'nip' => $request->nip,
            ]);
        }

        if ($store) {
            return redirect()->back()->with('success', 'Data pegawai berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data pegawai gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataEdit = MPegawai::find($id);
        $data = MPegawai::all();
        return view('master.pegawaii', ['data' => $data ?? []]);
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
        $hapus = MPegawai::destroy($id);

        if ($hapus) {
            return redirect()->back()->with('success', 'Data pegawai berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data pegawai gagal dihapus');
        }
    }

    /**
     * Modal Tambah/Edit Pegawai
     */
    public function modalAddPegawai(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
            $data = MPegawai::find($id);
        }
        $view = view('master.modalAddPegawai', ['data' => $data ?? ""])->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Modal Tambah User dari Pegawai
     */
    public function modalAddUser(Request $request)
    {
        $id = $request->id;

        $pegawai = MPegawai::where('id', $id)->first();

        $data = [
            'password' => $pegawai->nip,
            'id_pegawai' => $id
        ];

        $view = view('master.modalAddUsers', $data)->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Simpan User dari Pegawai
     */
    public function saveUser(Request $request)
    {
        $id_pegawai = $request->id_pegawai;
        $password = $request->password;
        $username = $request->username;

        $data = [
            'username' => $username,
            'password' => Hash::make($password),
        ];

        $userstore = User::create($data);

        if ($userstore) {
            $user_id = $userstore->id;

            // Hubungkan ke tabel pegawai
            MPegawai::where('id', $id_pegawai)->update([
                'user_id' => $user_id,
            ]);
        }

        return redirect()->back()->with(['success' => 'User berhasil dibuat dan dihubungkan dengan pegawai']);
    }
}
