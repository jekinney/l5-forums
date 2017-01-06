<?php

namespace App\Http\Controllers\Auth;

use App\Users\Models\User;
use App\Http\Requests\Auth\Register;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Register $request, User $user)
    {
        $user->create([
            'slug' => str_slug($request->name),
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect('/auth/login');
    }
}
