<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Services::all();
        return view('services', ['services' => $services]);
    }
}
