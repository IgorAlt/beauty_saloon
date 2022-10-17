<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    /**
     * Отображение всех купонов
     *
     * @return View
     */
    public function index(): View
    {
        $coupons = Coupon::query()
            ->get();

        return view('coupons', [
            'coupons' => $coupons
        ]);
    }

    /**
     * Показывает форму добавления нового купона
     *
     * @return View
     */
    public function create(): View
    {
        $services = Services::query()->get();
        $users = User::query()->get();

        return view('coupons_form', [
            'services' => $services,
            'users' => $users,
        ]);
    }

    /**
     * Создание нового купона
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $serviceA = '';
        foreach ($request->services as $service) {
            $serviceA .= $service . ' ';
        }

        $userA = '';
        foreach ($request->user as $user) {
            $userA .= $user . ' ';
        }

        Coupon::query()->create([
            'name' => $request->name,
            'services' => $serviceA,
            'count' => $request->count,
            'user' => $userA,
            'percent' => $request->percent,
            'discount' => $request->discount,
        ]);

        return redirect()->route('coupons.index');
    }

    /**
     * Показывает форму редактирования купона
     *
     * @param  Coupon  $coupon
     * @return View
     */
    public function edit(Coupon $coupon): View
    {
        $services = Services::query()->get();
        $users = User::query()->get();

        return view('coupons_form', [
            'coupon' => $coupon,
            'services' => $services,
            'users' => $users,
        ]);
    }

    /**
     * Редактирует купон
     * @param  Request  $request
     * @param  Coupon  $coupon
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Coupon $coupon): RedirectResponse
    {
        $serviceA = '';
        foreach ($request->services as $service) {
            $serviceA .= $service . ' ';
        }

        $userA = '';
        foreach ($request->user as $user) {
            $userA .= $user . ' ';
        }

        $coupon->update([
            'name' => $request->name,
            'services' => $serviceA,
            'count' => $request->count,
            'user' => $userA,
            'percent' => $request->percent,
            'discount' => $request->discount,
        ]);

        return redirect()->route('coupons.index');
    }

    /**
     * Удаляет купон
     * @param  Coupon  $coupon
     *
     * @return RedirectResponse
     */
    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        return redirect()->route('coupons.index');
    }
}
