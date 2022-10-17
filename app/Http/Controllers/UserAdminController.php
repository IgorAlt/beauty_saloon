<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserAdminController extends Controller
{
    /**
     * Отображение всех пользователей
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::query()
            ->get();

        return view('users_admin', [
            'users' => $users
        ]);
    }

    /**
     * Отображает форму для редактирования пользователя
     * @param  User $user_admin
     *
     * @return View
     */
    public function edit(User $user_admin): View
    {
        return view('users_form', [
            'user_admin' => $user_admin
        ]);
    }

    /**
     * Редактирование пользователя
     * @param  Request  $request
     * @param  User  $user_admin
     *
     * @return RedirectResponse
     */
    public function update(Request $request, User $user_admin): RedirectResponse
    {
        $user_admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'loyalty_level' => $request->loyalty_level,
            'full_sum' => $request->full_sum,
        ]);

        return redirect()->route('user-admin.index');
    }

    /**
     * Удаляет пользователя
     * @param  User  $user_admin
     *
     * @return RedirectResponse
     */
    public function destroy(User $user_admin): RedirectResponse
    {
        $user_admin->delete();

        return redirect()->route('user-admin.index');
    }
}
