<?php

namespace App\Http\Controllers;

use App\Models\MTimModel;
use App\Models\TimModel;
use Illuminate\Http\Request;

class TimController extends Controller
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
     */
    public function store(Request $request)

         {
        $request->validate(
            ['tim_penanggung_jawab' => 'required']
        );
        if($request->id != ""){
        $store = MTimModel::where('id', $request->id)->update([
            'tim_penanggung_jawab' => $request-> tim_penanggung_jawab
        ]);
        }else{
            $store = MTimModel::create($request->all());
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
    public function show(string $id)
    {
         $dataEdit = MTimModel::find($id);
            $data = MTimModel::all();
        return view('master.tim',['data' => $data ?? []]);
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
         $hapus = MTimModel::destroy($id);

        if($hapus){
            return redirect()->back()->with('success','berhasl hapus');
        }else{
            return redirect()->back()->with('success','gagal hapus');
        }
    }


    public function modalAddTim(Request $request){
        $id = $request->id;
        if(!empty($id)){
            $data = MTimModel::find($id);
        }
            $view = view('master.modalAddTim',['data' => $data ?? ""])->render();
        return response()->json(['html' => $view]);
    }
}
