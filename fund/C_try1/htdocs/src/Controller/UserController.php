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

    function profilePage() {
        $myFunds = DB::fetchAll("SELECT * FROM funds WHERE owner = ?", [user()->user_email]);

        $investorFunds = DB::fetchAll("SELECT * FROM funds F
                                       LEFT JOIN investors I ON I.email = ? 
                                       WHERE F.fund_num = I.fund_num", [user()->user_email]);

        $business = DB::fetchAll("SELECT * FROM business WHERE user_email = ?", [user()->user_email]);

        view("profile", compact("myFunds", "investorFunds", "business"));
    }

    function investorProfilePage() {
        extract($_GET);

        $users = DB::fetch("SELECT * FROM users WHERE user_email = ?", [$investor_email]);

        $myFunds = DB::fetchAll("SELECT * FROM funds WHERE owner = ?", [$investor_email]);
        
        $investorFunds = DB::fetchAll("SELECT * FROM funds F
                                       LEFT JOIN investors I ON I.email = ? 
                                       WHERE F.fund_num = I.fund_num", [$investor_email]);

        $business = DB::fetchAll("SELECT * FROM business WHERE user_email = ?", [$investor_email]);

        view("investorProfile", compact("users", "myFunds", "investorFunds", "business"));
    }

    function adminPage() {
        $funds = DB::fetchAll("SELECT * FROM funds");
        $users = DB::fetchAll("SELECT * FROM users");
        
        view("admin", compact("funds", "users"));
    }
}