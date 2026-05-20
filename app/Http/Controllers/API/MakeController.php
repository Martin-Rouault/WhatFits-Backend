<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Make;
use Illuminate\Http\Request;

class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $makes = Make::orderBy('name')->get();

        return response()->json($makes);
    }

    /**
     * Display the specified resource.
     */
    public function carModels(Make $make)
    {
        return response()->json($make->car_model()->orderBy('name')->get());
    }
}
