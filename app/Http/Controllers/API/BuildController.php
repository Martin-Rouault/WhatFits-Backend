<?php

namespace App\Http\Controllers\API;

use App\Filters\BuildFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuildRequest;
use App\Http\Requests\UpdateBuildRequest;
use App\Http\Resources\BuildResource;
use App\Models\Build;
use App\Services\BuildPhotoService;
use Illuminate\Http\Request;


// TODO faire les tests
class BuildController extends Controller
{
    public function __construct(
        protected BuildPhotoService $photoService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Build::with(['carModel.make', 'wheel.wheel_brand', 'user', 'photos', 'likes'])
            ->latest();

        $builds = (new BuildFilter($request))->apply($query)->paginate(15);

        return BuildResource::collection($builds);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuildRequest $request)
    {
        $this->authorize('create', Build::class);

        $build = $request->user()->builds()->create($request->safe()->except('photos'));

        $photos = $request->file('photos', []);

        $this->photoService->store($build, $photos);

        $build->load('carModel.make', 'wheel.wheel_brand', 'user', 'photos');

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

        $build->update($request->safe()->except('add', 'delete', 'reorder'));

        $this->photoService->update($build, $request->validated());

        $build->load('carModel.make', 'wheel.wheel_brand', 'user', 'photos');

        return new BuildResource($build);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $build = Build::findOrFail($id);

        $this->authorize('delete', $build);

        $this->photoService->delete($build);

        $build->delete();

        return response()->noContent();
    }
}
