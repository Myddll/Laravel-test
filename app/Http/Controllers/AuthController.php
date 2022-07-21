<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotForm;
use App\Http\Requests\LoginForm;
use App\Http\Requests\RegisterForm;
use App\Mail\ForgotMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view("auth.register");
    }

    // Получаем данные с реквест формы RegisterForm и регистрируемся
    public function register(RegisterForm $request)
    {
        $data = $request->only(["name", "email", "password"]);

        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password']),
        ]);

        // Вход в аккаунт
        if($user)
        {
            auth("web")->login($user);
        }

        return redirect(route("home"));
    }

    public function logout()
    {
        auth("web")->logout();

        return redirect(route("home"));
    }

    public function showLoginForm()
    {
        return view("auth.login");
    }

    // Получаем данные с реквест формы LoginForm и входим
    public function login(LoginForm $request)
    {
        $data = $request->only(["email", "password"]);

        if(auth("web")->attempt($data))
        {
            return redirect(route("home"));
        }

        return redirect(route("login"))->withErrors(["email" => "Пользователь не найден, или данные введены неверно!"]);
    }

    public function showForgotForm()
    {
        return view("auth.forgot");
    }

    public function forgot(ForgotForm $request)
    {
        $data = $request->only(["email"]);
        $user = User::where(["email" => $data["email"]])->first();

        $password = uniqid();
        $user->password = bcrypt($password);
        $user->save();
        Mail::to($user)->send(new ForgotMail($password));
        return redirect(route("home"));
    }
}
