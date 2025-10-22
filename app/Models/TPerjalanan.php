<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPerjalanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 't_perjalanan';
    protected $guarded = ['id'];

    /**
     * Relasi ke model User
     * Setiap perjalanan dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
public function rincian()
{
    return $this->hasMany(TRincian::class, 'perjalanan_id');
}
}
