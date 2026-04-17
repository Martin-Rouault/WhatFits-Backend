<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * Verify the specified email
     */
    public function verify(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();

        return response()->json(['message' => 'Email vérifié avec succès'], 200);
    }

    /**
     * Resend the specified email verification link
     */
    public function resend(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur introuvable.'], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Ce compte est déjà activé.'], 422);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Lien de vérification renvoyé !'], 200);
    }
}
