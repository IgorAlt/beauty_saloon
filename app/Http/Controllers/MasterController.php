<?php

namespace App\Http\Controllers;

use App\Models\Masters;
use Illuminate\View\View;

class MasterController extends Controller
{
    /**Отображает всех мастеров
     * @return View
     */
    public function index(): View
    {
        $masters = Masters::all();
        return view('masters', ['masters' => $masters]);
    }

    public function show($request)
    {
        $thisMaster = Masters::query()->where('id', $request)->first();

        return view('master', ['thisMaster' => $thisMaster]);
    }
}
