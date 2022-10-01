<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceAdminController extends Controller
{
    /**Отображение главной страницы изменения услуг
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $services = Services::query()
            ->get();

        return view('services_admin', ['services' => $services]);
    }

    /**Показывает форму создания новой услуги
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('services_form');
    }

    /**Создание новой услуги
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Services::query()->create([
            'service' => $request->service,
            'price' => $request->price,
        ]);

        return redirect()->route('services_admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Services  $services_admin
     * @return RedirectResponse
     */
    public function show(Services $services_admin)
    {
        //
    }

    /**Показ формы редактирования услуги
     * Show the form for editing the specified resource.
     *
     * @param  Services  $services_admin
     * @return View
     */
    public function edit(Services $services_admin): View
    {
        return view('services_form', ['services_admin' => $services_admin]);
    }

    /**Редактирование услуги
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Services  $services_admin
     * @return RedirectResponse
     */
    public function update(Request $request, Services $services_admin): RedirectResponse
    {
        $services_admin->update([
            'service' => $request->service,
            'price' => $request->price,
        ]);

        return redirect()->route('services_admin.index');
    }

    /**Удаление услуги
     * Remove the specified resource from storage.
     *
     * @param  Services  $services_admin
     * @return RedirectResponse
     */
    public function destroy(Services $services_admin): RedirectResponse
    {
        $services_admin->delete();

        return redirect()->route('services_admin.index');
    }
}
