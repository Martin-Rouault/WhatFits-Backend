<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        /**
         * Login the requested user & checking if his email is verified.
         */
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request->email, 'and')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Veuillez vérifier votre email afin de pouvoir vous connecter'
            ], 403);
        }

        Auth::guard('web')->login($user);

        $request->session()->regenerate();

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Logout the requested user & invalidate his session.
     */
    public function logout(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }

    /**
     * Register a new user & send a new registered event in order to verify his email.
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'required|email|max:255|unique:users,email', 
            'password' => ['required', Password::default()]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => 'Veuillez vérifier votre email',
        ], 201);
    }
}
