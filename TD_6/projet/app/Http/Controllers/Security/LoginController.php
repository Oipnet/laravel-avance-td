<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('homepage');
        }

        return view('security.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->back();
        }

        return back()->withErrors([
            'email' => 'Bad credentials'
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse|JsonResponse
    {
        Auth::logout();

        return $request->isJson() ?
            new JsonResponse(['success' => 'logout', 'redirect_to' => route('homepage')]) :
            redirect()->route('homepage');
    }
}
