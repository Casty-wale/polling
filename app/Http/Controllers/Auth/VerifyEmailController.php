<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Cookie;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @param  \App\Http\Requests\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        $user = \App\Models\User::find($request->id);

        abort_if(!$user, 403);
        abort_if(! hash_equals((string) $request->hash,
        sha1($user->getEmailForVerification())), 403);
        // $cookie = Cookie::make('nameTakeer', 'guarded');
        
        if ($user->hasVerifiedEmail()) {
            // return redirect()->intended(RouteServiceProvider::VERIFIED.'?verified=2')->header('Content-Type', "value");
            // return redirect()->intended(RouteServiceProvider::VERIFIED.'?verified=2')->withCookie($cookie);
            return redirect()->intended(RouteServiceProvider::VERIFIED.'?verified=2')->withCookie('didPass', 'guarded', 5);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // return redirect()->intended(RouteServiceProvider::VERIFIED.'?verified=1')->header('Content-Type', "value");
        // return redirect()->intended(RouteServiceProvider::VERIFIED.'?verified=1')->withCookie($cookie);
        return redirect()->intended(RouteServiceProvider::VERIFIED.'?verified=1')->withCookie('didPass', 'guarded', 5);






        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(
        //         config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
        //     );
        // }

        // if ($request->user()->markEmailAsVerified()) {
        //     event(new Verified($request->user()));
        // }

        // return redirect()->intended(
        //     config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
        // );
    }
}
