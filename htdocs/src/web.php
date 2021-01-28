<?php

use App\Router;

Router::get("/", "MainController@indexPage");
Router::post("/detail", "MainController@detailPage");

Router::get("/join", "UserController@joinPage");
Router::post("/join", "UserController@join");
Router::get("/login", "UserController@loginPage");
Router::post("/login", "UserController@login");
Router::get("/logout", "UserController@logout");

Router::get("/register", "MainController@registerPage");
Router::post("/insert/fund", "MainController@insertFund");

Router::get("/view", "MainController@viewPage");
Router::get("/view/{id}", "MainController@viewPage");

Router::get("/investor", "MainController@investorPage");

Router::start();