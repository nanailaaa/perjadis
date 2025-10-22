<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MJenisTransport extends Model
{
   protected  $table =  'm_jenis_transport';
    protected $guarded = [
        'id',
        'updated_at',
        'created_at'
    ];
}
