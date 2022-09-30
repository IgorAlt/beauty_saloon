<?php

namespace App\Http\Controllers;

use App\Models\Masters;
use Illuminate\Http\Request;

class MasterAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maestros = Masters::get();

        return view('masters_admin', compact('maestros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Masters::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'social_media' => $request->social_media,
            'information' => $request->information,
            'images' => $request->file('images')->store('uploads', 'public')
        ]);

        return redirect()->route('masters_admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function show(Masters $masters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function edit(Masters $masters_admin)
    {
        return view('masters_form', compact('masters_admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masters $masters_admin)
    {
        $masters_admin->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'social_media' => $request->social_media,
            'information' => $request->information,
            'images' => $request->file('images')->store('uploads', 'public')
        ]);

        return redirect()->route('masters_admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masters $masters_admin)
    {
        $masters_admin->delete();

        return redirect()->route('masters_admin.index');
    }
}
