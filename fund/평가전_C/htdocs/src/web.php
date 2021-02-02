<?php

use App\Router;

Router::get("/", "MainController@indexPage");
Router::post("/detail", "MainController@detailPage");
Router::get("/detail/profile", "UserController@investorProfilePage");

Router::get("/join", "UserController@joinPage");
Router::post("/join", "UserController@join");
Router::get("/login", "UserController@loginPage");
Router::post("/login", "UserController@login");
Router::get("/logout", "UserController@logout");

Router::get("/profile", "UserController@profilePage");
Router::get("/investor/profile", "UserController@investorProfilePage");

Router::get("/admin", "UserController@adminPage");
Router::post("/delete/fund", "MainController@deleteFund");
Router::post("/delete/user", "UserController@deleteUser");
Router::post("/insert/user/money", "UserController@insertMoney");

Router::get("/view", "MainController@viewPage");
Router::get("/view/{id}", "MainController@viewPage");
Router::post("/insert/invest", "MainController@insertInvestor");

Router::post("/insert/business", "MainController@insertBusiness");

Router::get("/register", "MainController@registerPage");
Router::post("/insert/fund", "MainController@insertFund");

Router::get("/investor", "MainController@investorPage");
Router::get("/investor/{id}", "MainController@investorPage");

Router::start();