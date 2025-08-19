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
            ->get();
    }
}
