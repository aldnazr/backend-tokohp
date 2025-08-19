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
        $name = $request->query('name');

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
    public function update(Request $request)
    {
        $id = $request->query('id');
        $name = $request->query('name');

        $brand = Brand::findOrFail($id);

        $request->merge([
            'NAMA_BRAND' => $name
        ]);

        $validated = $request->validate([
            'NAMA_BRAND' => 'required|string|unique:brands,NAMA_BRAND,' . $id . ',ID_BRAND',
        ]);

        $brand->update($validated);

        return response()->json([
            'message' => 'Brand berhasil diupdate',
            'data' => $brand
        ], 202);
    }

    // Delete
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(status: 204);
    }
}
