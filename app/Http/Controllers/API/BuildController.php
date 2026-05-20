<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuildRequest;
use App\Http\Requests\UpdateBuildRequest;
use App\Http\Resources\BuildResource;
use App\Models\Build;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// TODO faire les tests
class BuildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO faire les filtres
        $builds = Build::with(['carModel.make', 'wheel.wheel_brand', 'user', 'photos', 'likes'])
            ->latest()
            ->paginate(15);

        return BuildResource::collection($builds);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuildRequest $request)
    {
        $this->authorize('create', Build::class);

        $build = $request->user()->builds()->create($request->validated());

        $build->load('carModel.make', 'wheel.wheel_brand', 'user');

        return new BuildResource($build);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $build = Build::with(['carModel.make', 'wheel.wheel_brand', 'user', 'likes', 'photos'])->findOrFail($id);

        return new BuildResource($build);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBuildRequest $request, string $id)
    {
        $build = Build::findOrFail($id);

        $this->authorize('update', $build);

        $build->update($request->validated());

        $build->load('carModel.make', 'wheel.wheel_brand', 'user');

        return new BuildResource($build);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $build = Build::findOrFail($id);

        $this->authorize('delete', $build);

        $build->delete();

        return response()->noContent();
    }
}
