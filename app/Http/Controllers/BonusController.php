<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BonusController extends Controller
{
    /**
     *
     * @return View
     */
    public function index(): View
    {
        return view('bonus');
    }
}
