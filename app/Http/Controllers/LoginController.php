<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\MagicLoginLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function store(LoginRequest $request)
    {
        Mail::to($request->email)->send(new MagicLoginLink($request->email));

        return back()->with('success', 'Magic login link has been send in your email.');
    }

    public function session(User $user)
    {
        auth()->login($user);

        return redirect()->route('home');
    }
}
