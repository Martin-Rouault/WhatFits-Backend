<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Build;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Toggle like / unlike of the build.
     */
    public function toggle(Request $request, Build $build)
    {
        $user = $request->user();

        $existingLike = $build->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            $build->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $build->likes()->count()
        ]);
    }
}
