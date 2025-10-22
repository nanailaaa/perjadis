<?php

namespace App\Http\Controllers;

use App\Models\JenisModel;
use App\Models\MJenisTransport;
use Illuminate\Http\Request;

class JenisController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['jenis_transport' => 'required']
        );
        if($request->id != ""){
        $store = MJenisTransport::where('id', $request->id)->update([
            'jenis_transport' => $request->jenis_transport
        ]);
        }else{
            $store = MJenisTransport::create($request->all());
        }

        if($store){
            return redirect()->back()->with('success','data berhasil disimpan');
        }else{
            return redirect()->back()->with('erorr','data gagal disimpan');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $dataEdit = MJenisTransport::find($id);
            $data = MJenisTransport::all();
        return view('master.transportasi',['data' => $data ?? []]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $hapus = MJenisTransport::destroy($id);

        if($hapus){
            return redirect()->back()->with('success','berhasl hapus');
        }else{
            return redirect()->back()->with('success','gagal hapus');
        }
    }

    public function modalAdd(Request $request){
        $id = $request->id;
        if(!empty($id)){
            $data = MJenisTransport::find($id);
        }
            $view = view('master.modalAddTransport',['data' => $data ?? ""])->render();
        return response()->json(['html' => $view]);
    }
}
