<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserPrivateResource;
use App\Http\Resources\UserPublicResource;
use App\Models\User;
use Illuminate\Http\Request;

// TODO faire les tests
class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->with([
            'builds.carModel.make',
            'builds.wheel.wheel_brand',
            'builds.photos',
            'builds.likes'
        ]);

        return new UserPublicResource($user);
    }

    /**
     * Display the specified connected user.
     */
    public function me(Request $request): UserPrivateResource
    {
        $user = $request->user()->load([
            'builds.carModel.make',
            'builds.wheel.wheel_brand',
            'builds.photos',
            'builds.likes'
        ]);

        return new UserPrivateResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        return new UserPrivateResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->noContent();
    }
}
