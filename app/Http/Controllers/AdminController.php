<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Главная страница панели администратора.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin');
    }
}
