<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Read
    public function index()
    {
        return Brand::orderBy('id_brand')->get();
    }

    // Create
    public function insert(Request $request)
    {
        $name = $request->input('NAMA_BRAND');

        // insert ke database
        $brand = Brand::create([
            'NAMA_BRAND' => $name
        ]);

        return response()->json([
            'success' => true,
            'data' => $brand,
        ]);
    }

    // Update
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->update([
            'NAMA_BRAND' => $request->input('NAMA_BRAND')
        ]);

        return response()->json([
            'message' => 'Brand berhasil diupdate',
            'data' => $brand
        ], 202);
    }

    // Delete
    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(status: 204);
    }
}
