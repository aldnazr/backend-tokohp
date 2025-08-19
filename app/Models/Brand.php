<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Nama tabel
    protected $table = 'brands';

    // Primary key
    protected $primaryKey = 'ID_BRAND';

    // Kalau tipe primary key bukan bigint tapi int
    protected $keyType = 'int';

    // Nonaktifkan timestamps (karena tabel tidak ada created_at, updated_at)
    public $timestamps = false;

    // Kolom yang boleh diisi lewat mass assignment
    protected $fillable = [
        'NAMA_BRAND',
    ];
}
