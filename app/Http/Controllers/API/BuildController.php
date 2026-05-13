<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuildRequest;
use App\Models\Build;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BuildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Build::with(['carModel', 'wheel', 'user', 'photos', 'likes'])
            ->when($request->filled('car_year'), fn($q) => $q->where('car_year', $request->input('car_year')))
            ->when($request->filled('make_id'), fn($q) => $q->whereHas('carModel', fn($q2) => $q2->where('make_id', $request->input('make'))))
            ->latest()
            ->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuildRequest $request)
    {
        $build = $request->user()->builds()->create($request->validated());

        return response()->json($build, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
