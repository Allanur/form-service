<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Cache\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdatePassword;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private $maxAttempts = 5;
    private $decayMinutes = 1;

    public function editPasswordForm()
    {
        return view('auth.edit-password');
    }

    public function updatePassword(UpdatePassword $request)
    {
        $request->user()->password = Hash::make($request->password);
        $request->user()->save();

        return back()->with('success', 'Password changed successfully');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|exists:users',
            'password' => 'required',
            'remember' => 'nullable|boolean'
        ]);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {

            event(new Lockout($request));

            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );

            throw ValidationException::withMessages([
                'username' => [Lang::get('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ])],
            ])->status(Response::HTTP_TOO_MANY_REQUESTS);
        }

        $credentials = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];

        if (Auth::guard()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $this->limiter()->clear($this->throttleKey($request));

            return $request->wantsJson()
                ? new Response('', 204)
                : redirect()->intended();
        }

        $this->limiter()->hit(
            $this->throttleKey($request), $this->decayMinutes * 60
        );

        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('login');
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts
        );
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('username')).'|'.$request->ip();
    }
}
