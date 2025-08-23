<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    // Nama tabel
    protected $table = 'phones';

    // Primary key
    protected $primaryKey = 'ID_PHONE';

    // Kalau tipe primary key bukan bigint tapi int
    protected $keyType = 'int';

    // Nonaktifkan timestamps (karena tabel tidak ada created_at, updated_at)
    public $timestamps = false;

    // Kolom yang boleh diisi lewat mass assignment
    protected $fillable = [
        'ID_BRAND',
        'NAMA_HANDPHONE',
        'DESKRIPSI',
        'HARGA',
        'STOK'
    ];
}
