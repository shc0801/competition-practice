<?php

namespace Controller;

use App\DB;

class UserController {
    function joinPage() {
        view("join");
    }

    function join() {
        extract($_POST);

        if($password != $password2) back("비밀번호와 비밀번호 확인이 일치하지 않습니다");

        $guest = DB::who($user_email);
        if($guest) back("중복되는 아이디입니다. 다른 아이디를 사용해주세요");

        DB::query("INSERT INTO users(user_email, user_name, password) VALUES(?, ?, ?)", [$user_email, $user_name, $password]);

        go("/", "회원가입 되었습니다.");
    }
    
    function loginPage() {
        view("login");
    }

    function login() {
        extract($_POST);

        $user = DB::who($user_email);
        if(!$user || $password !== $user->password) back("아이디 또는 비밀번호가 일치하지 않습니다.");

        $_SESSION["user"] = $user;

        go("/", "로그인 되었습니다.");
    }

    function logout() {
        unset($_SESSION["user"]);
        go("/", "로그아웃 되었습니다.");
    }
}