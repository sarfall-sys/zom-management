<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class TwoFActorController extends Controller
{
    protected $google2fa;
    public function __construct(Google2FA $google2fa)
    {
        $this->middleware('auth');
        $this->google2fa = $google2fa;
    }

    public function enable(Request $request)
    {
        $user = $request->user();
        $google2fa = $this->google2fa;

        // Generate a new secret key
        $secret = $google2fa->generateSecretKey();

        // Save the secret key to the user's record
        $user->google2fa_secret = $secret;
        $user->save();

        // Generate the QR code URL for the user to scan with their 2FA app
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        return response()->json([
            'message' => 'Two-factor authentication enabled successfully.',
            'qr_code_url' => $qrCodeUrl,
        ]);

    }

    public function confirm(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'code' => 'required|digits:6',
        ]);
        $user = $request->user();

        // Verify the provided code against the user's secret
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->input('code'));

        // If the code is valid, enable 2FA for the user
        if ($valid) {
            $user->two_factor_enabled = true;
            $user->save();

            return response()->json([
                'message' => 'Two-factor authentication confirmed and enabled successfully.',
            ]);
        }

        return response()->json([
            'message' => 'Invalid 2FA code. Please try again.',
        ], 422);

    }
}
