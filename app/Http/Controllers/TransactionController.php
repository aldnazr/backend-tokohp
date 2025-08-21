<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        return DB::table('phones')
            ->join('brands', 'phones.id_brand', '=', 'brands.id_brand')
            ->select('*')
            ->where('phones.stok', '>', 0)
            ->get();
    }

    public function insert(Request $request)
    {
        $id_user        = $request->input('id_user');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $total          = $request->input('total_harga');
        $items          = $request->input('items', []);  // array of objects

        $tanggal = now();

        // insert transaksi
        $id_transaksi = DB::table('transaksi')->insertGetId([
            'id_user'        => $id_user,
            'nama_pelanggan' => $nama_pelanggan,
            'tanggal'        => $tanggal,
            'total_harga'    => $total,
        ]);

        // insert detail_transaksi
        foreach ($items as $item) {
            $jumlah   = $item['jumlah'] ?? 0;
            $harga    = $item['harga'] ?? 0;
            $subtotal = $jumlah * $harga;

            DB::table('detail_transaksi')->insert([
                'id_transaksi'     => $id_transaksi,
                'id_phone'         => $item['id_phone'],
                'harga_barang'     => $harga,
                'jumlah_pembelian' => $jumlah,
                'subtotal'         => $subtotal,
            ]);
        }

        return response()->json([
            'success'      => true,
            'id_transaksi' => $id_transaksi,
            'total_harga'  => $total,
        ]);
    }
}
