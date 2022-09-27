<?php

namespace App\Http\Controllers;

use App\Models\Masters;
use App\Models\Media;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $masters = Masters::all();
        $images = Media::all();
        return view('main', compact('masters', 'images'));
    }
}
