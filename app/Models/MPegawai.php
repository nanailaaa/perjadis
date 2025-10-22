<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MPegawai extends Model
{
    protected $table = "m_pegawai";

    protected $guarded = [
        'id',
        'updated_at',
        'created_at',
    ];

    // Relasi ke User
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}

