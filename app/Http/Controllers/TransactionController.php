<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // validasi data
        $request->validate([
            'id_user' => 'required|integer',
            'nama_pelanggan' => 'required|string',
            'tanggal' => 'required|date',
            'total_harga' => 'required|numeric',
            'items' => 'required|array',
            'items.*.id_produk' => 'required|integer',
            'items.*.harga' => 'required|numeric',
            'items.*.jumlah' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            // insert transaksi (header)
            $idTransaksi = DB::table('transaksi')->insertGetId([
                'id_user' => $request->id_user,
                'nama_pelanggan' => $request->nama_pelanggan,
                'tanggal' => $request->tanggal,
                'total_harga' => $request->total_harga
            ]);

            // insert detail transaksi (items)
            foreach ($request->items as $item) {
                $subtotal = $item['harga'] * $item['jumlah'];

                DB::table('detail_transaksi')->insert([
                    'id_transaksi' => $idTransaksi,
                    'id_phone' => $item['id_produk'],
                    'harga_barang' => $item['harga'],
                    'jumlah_pembelian' => $item['jumlah'],
                    'subtotal' => $subtotal
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan',
                'id_transaksi' => $idTransaksi
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function insert(Request $request)
    {
        $id_user        = $request->query('id_user');
        $nama_pelanggan = $request->query('nama_pelanggan');
        $phones         = $request->query('phones', []);   // array id_phone
        $jumlahs        = $request->query('jumlah', []);   // array jumlah
        $hargas         = $request->query('harga', []);    // array harga

        $tanggal  = now();
        $total    = 0;

        // hitung total harga dulu
        foreach ($phones as $i => $id_phone) {
            $jumlah   = $jumlahs[$i] ?? 0;
            $harga    = $hargas[$i] ?? 0;
            $subtotal = $jumlah * $harga;
            $total   += $subtotal;
        }

        // insert ke transaksi
        $id_transaksi = DB::table('transaksi')->insertGetId([
            'id_user'        => $id_user,
            'nama_pelanggan' => $nama_pelanggan,
            'tanggal'        => $tanggal,
            'total_harga'    => $total,
        ]);

        // insert ke detail_transaksi
        foreach ($phones as $i => $id_phone) {
            $jumlah   = $jumlahs[$i] ?? 0;
            $harga    = $hargas[$i] ?? 0;
            $subtotal = $jumlah * $harga;

            DB::table('detail_transaksi')->insert([
                'id_transaksi'     => $id_transaksi,
                'id_phone'         => $id_phone,
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
