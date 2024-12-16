<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->usertype == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($request->user()->usertype == 'student') {
            return redirect()->route('student.nodue_apply');
        } elseif ($request->user()->usertype == 'sso') {
            return redirect()->route('sso.homeboard');
        } elseif ($request->user()->usertype == 'concerned_person') {
            return redirect()->route('concerned_person.dashboard');
        } elseif ($request->user()->usertype == 'librarian') {
            return redirect()->route('librarian.search-dues');
        }
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
