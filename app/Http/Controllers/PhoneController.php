<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneController extends Controller
{
    public function index()
    {
        return DB::table('phones')
            ->join('brands', 'phones.id_brand', '=', 'brands.id_brand')
            ->select('*')
            ->get();
    }

    public function insert(Request $request)
    {
        // Langsung ambil input dari request
        $id = Phone::insertGetId([
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

    public function update(Request $request, $id)
    {
        $phone = Phone::findOrFail($id);

        $phone->update([
            'NAMA_BRAND' => $request->input('NAMA_BRAND'),
            'NAMA_HANDPHONE' => $request->input('NAMA_HANDPHONE'),
            'DESKRIPSI' => $request->input('DESKRIPSI'),
            'HARGA' => $request->input('HARGA'),
            'STOK' => $request->input('STOK')
        ]);

        return response()->json([
            'message' => 'Phone berhasil diupdate',
            'data' => $phone
        ], 202);
    }

    public function delete($id)
    {
        $deleted = DB::table('phones')
            ->where('ID_PHONE', $id)
            ->delete();

        if ($deleted) {
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Not Found'], 404);
    }
}
