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
}
