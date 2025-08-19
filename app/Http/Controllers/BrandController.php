<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Create
    public function store(Request $request)
    {
        // validasi
        $validated = $request->validate([
            'NAMA_BRAND' => 'required|string|max:100|unique:brand,NAMA_BRAND',
        ]);

        // simpan ke DB
        $brand = Brand::create($validated);

        return response()->json([
            'message' => 'Brand berhasil dibuat',
            'data' => $brand
        ], 201);
    }

    // Read
    public function index()
    {
        return Brand::orderBy('id_brand')->get();
    }

    // Update
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'NAMA_BRAND' => 'required|string|unique:brand,NAMA_BRAND,' . $id . ',ID_BRAND',
        ]);

        $brand->update($validated);
        return response()->json($brand);
    }

    // Delete
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(null, 204);
    }
}
