<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianModel extends Model
{
    use HasFactory;

    protected $table = 't_rincians';
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function perjalanan()
    {
        return $this->belongsTo(TPerjalanan::class, 'perjalanan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transportBerangkat()
    {
        return $this->belongsTo(MJenisTransport::class, 'jenis_transport_berangkat');
    }

    public function transportPulang()
    {
        return $this->belongsTo(MJenisTransport::class, 'jenis_transport_pulang');
    }

    public function transportBandara()
    {
        return $this->belongsTo(MJenisTransport::class, 'jenis_transport_bandara');
    }
}
