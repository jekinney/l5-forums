<?php

namespace App\Http\Controllers\Auth;

use App\Users\Models\User;
use App\Http\Requests\Auth\Login;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Display the login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Auth\Login  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Login $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember'))) {
                return back()->withErrors('Invalid Credentials');
        }
        return redirect()->intended('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
