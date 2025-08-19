<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        return DB::table('transaksi as t')
            ->join('detail_transaksi as dt', 't.id_transaksi', '=', 'dt.id_transaksi')
            ->join('users as usr', 't.id_user', '=', 'usr.id_user')
            ->join('phones as ph', 'dt.id_phone', '=', 'ph.id_phone')
            ->join('brands as br', 'ph.id_brand', '=', 'br.id_brand')
            ->select(
                't.id_transaksi',
                'usr.nama_lengkap as pelayan',
                't.nama_pelanggan',
                't.tanggal',
                'br.nama_brand',
                'ph.nama_handphone',
                'dt.harga_barang',
                'dt.jumlah_pembelian',
                'dt.subtotal',
                't.total_harga'
            )
            ->orderByDesc('t.id_transaksi')
            ->get();
    }
}
