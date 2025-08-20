<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneController extends Controller
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
        // Langsung ambil input dari request
        $id = DB::table('phones')->insertGetId([
            'ID_BRAND'       => $request->input('ID_BRAND'),
            'NAMA_HANDPHONE' => $request->input('NAMA_HANDPHONE'),
            'HARGA'          => $request->input('HARGA'),
            'STOK'           => $request->input('STOK'),
            'DESKRIPSI'      => $request->input('DESKRIPSI'),
        ]);

        // Return response JSON
        return response()->json([
            'success' => true,
            'id'      => $id,
            'message' => 'Phone berhasil ditambahkan'
        ], 201);
    }
}
