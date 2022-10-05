<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

// use RealRashid\SweetAlert\Facades\Alert;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        Log::info('user Try to login with id : '.$request->staff_id);
        $request->authenticate();
        $request->session()->regenerate();
        Log::info('user '.$request->staff_id.' login');
        
        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Login Successfully!');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        
        Log::info('user '.Auth::user()->staff_id.' logout');
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/')->with('info', 'Logout Successfully!');
    }
}
