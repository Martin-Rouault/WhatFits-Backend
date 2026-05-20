<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WheelBrand;
use Illuminate\Http\Request;

class WheelBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wheel_brands = WheelBrand::orderBy('name')->get();

        return response()->json($wheel_brands);
    }

    /**
     * Display the specified resource.
     */
    public function wheels(WheelBrand $wheelBrand)
    {
        return response()->json($wheelBrand->wheels()->orderBy('name')->get());
    }
}
