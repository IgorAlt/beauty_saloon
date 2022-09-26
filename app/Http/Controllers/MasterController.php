<?php

namespace App\Http\Controllers;

use App\Models\Masters;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $masters = Masters::all();
        return view('masters', compact('masters'));
    }
}
