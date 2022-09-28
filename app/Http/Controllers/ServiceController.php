<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Services::all();
        return view('services', compact('services'));
    }
}
