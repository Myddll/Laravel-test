<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotForm;
use App\Http\Requests\LoginForm;
use App\Http\Requests\RegisterForm;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Token;
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

        $tokenString = random_bytes(20);
        $tokenString = bin2hex($tokenString);

        $checkToken = Token::where(["user_id" => $user['id']])->delete();

        $token = Token::create([
            "token" => $tokenString,
            "user_id" => $user['id'],
        ]);

        $message = [
            "token" => $tokenString,
            "name" => $user['name']
        ];

        //$password = uniqid();
        //$user->password = bcrypt($password);
        //$user->save();
        Mail::to($user->email)->send(new ResetPassword($message));
        return redirect(route("home"));
    }

    public function showResetForm($token)
    {
        $tokenReset = Token::where(["token" => $token])->first();

        if ($tokenReset === null)
        {
            return redirect(route("home"));
        }

        return view("auth.reset", [
        "token" => $tokenReset
    ]);
    }

    public function resetPassword(ResetPasswordRequest $request, $token)
    {
        $password = $request->only(["password"]);
        $checkToken = Token::where(["token" => $token])->first();

        if ($checkToken === null)
        {
            return redirect(route("home"));
        }

        $user = User::where(["id" => $checkToken['user_id']])->first();
        $user->password = bcrypt($password["password"]);
        $user->save();
        $checkToken->delete();

        return redirect(route("login"));
    }
}
