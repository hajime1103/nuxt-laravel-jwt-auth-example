<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    use VerifiesEmails;

    public function __construct()
    {
        $this->middleware('throttle:6,1');
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if (!$user->email_verified_at)
        {
            $user->markEmailAsVerified();
            event(new Verified($user));
            return new JsonResponse('Email Verified', 200);
        }
        return new JsonResponse('Email Verify Failed', 422);
    }

    public function resend(Request $request)
    {
        $user = User::where('email', $request->get('email'))->get()->first();
        if (!$user) {
            return new JsonResponse('No Such User', 422);
        }
        if ($user->hasVerifiedEmail()) {
            return new JsonResponse('Already Verified User', 200);
        }

        $user->sendEmailVerificationNotification();

        return new JsonResponse('Send Verify Email', 200);
    }
}
