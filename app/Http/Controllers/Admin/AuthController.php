<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginForm;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view("admin.auth.login");
    }

    // Получаем данные с реквест формы LoginForm и входим
    public function login(LoginForm $request)
    {
        $data = $request->only(["email", "password"]);

        if(auth("admin")->attempt($data))
        {
            return redirect(route("admin.products.index"));
        }

        return redirect(route("admin.login"))->withErrors(["email" => "Пользователь не найден, или данные введены неверно!"]);
    }

    public function logout()
    {
        auth("admin")->logout();

        return redirect(route("admin.login"));
    }
}
