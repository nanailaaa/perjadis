<?php

namespace App\Http\Controllers;

use App\Models\JenisModel;
use App\Models\MJenisTransport;
use App\Models\MPegawai;
use App\Models\MTimModel;
use App\Models\PegawaiModel;
use App\Models\TimModel;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Halaman Master Data Pegawai
     */
    public function pegawai()
    {
        $data = MPegawai::select('m_pegawai.*','users.username')->leftJoin('users','users.id','=','m_pegawai.user_id')->orderBy('m_pegawai.id', 'desc')->paginate(10); ;
        return view('master.pegawaii',['data'=>$data]);
    }

    /**
     * Halaman Master Data Tim Penanggung Jawab
     */
    public function tim()
    {
        $data = MTimModel::all();
        return view('master.tim',['data'=>$data]);
    }

    /**
     * Halaman Master Data Jenis Transportasi
     */
    public function transportasi()
    {
         $data = MJenisTransport::orderBy('id', 'DESC')->paginate(10);
         return view('master.transportasi', ['data' => $data]);
    }
}
