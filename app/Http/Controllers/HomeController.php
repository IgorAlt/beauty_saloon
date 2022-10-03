<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $user = Auth::user();
        return view('home', ['user' => $user]);
    }

    public function change(): View
    {
        $user = Auth::user();
        return view('user_change', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update([
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
        ]);

        return redirect()->route('home');
    }
}
