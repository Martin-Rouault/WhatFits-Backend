<?php

namespace App\Services;

use App\Models\Build;
use Illuminate\Support\Facades\Storage;

class BuildPhotoService
{
    public function store(Build $build, array $photos): void
    {
        foreach ($photos as $index => $photo) {
            $path = $photo->store("/builds/$build->id", 'r2');

            $build->photos()->create([
                'photo_url' => $path,
                'display_order' => $index
            ]);
        }
    }

    public function update(Build $build, array $payload): void
    {
        foreach ($payload['delete'] ?? [] as $photoId) {
            $photo = $build->photos()->find($photoId);

            if($photo) {
                Storage::disk('r2')->delete($photo->photo_url);
                $photo->delete();
            }
        }
        
        $maxOrder = $build->photos()->max('display_order') ?? -1;

        foreach ($payload['add'] ?? [] as $index => $photo) {            
            $path = $photo->store("/builds/$build->id", 'r2');

            $build->photos()->create([
                'photo_url' => $path,
                'display_order' => $maxOrder + 1 + $index
            ]);
        }

        foreach ($payload['reorder'] ?? [] as $index => $photoId) {
            $build->photos()->where('id', $photoId)->update([
                'display_order' => $index
            ]);
        }
    }

    public function delete(Build $build): void
    {
        foreach ($build->photos as $photo) {
            Storage::disk('r2')->delete($photo->photo_url);
            $photo->delete();
        }
    }
}
