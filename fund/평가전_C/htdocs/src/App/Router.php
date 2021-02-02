<?php

namespace App;

use App\DB;

class Router
{
    static $pages = [];
    static function __callStatic($name,$args){
        if(strtolower($_SERVER['REQUEST_METHOD']) == $name){
            self::$pages[] = $args;
        }
    }

    static function start(){
        $url = explode("?",$_SERVER['REQUEST_URI'])[0];
        foreach(self::$pages as $page){
            if($url == $page[0]) {
                
                $admin = DB::who('admin');
                
                if(!$admin) {
                    DB::query("INSERT INTO users(user_email, user_name, password) VALUES('admin', '관리자', 1234)");
                }

                if(user()) {
                    $user = DB::who(user()->user_email);
                    if($user) {
                        $_SESSION["user"] = $user;
                    }
                }
                $action = explode("@",$page[1]);
                $conName = "Controller\\$action[0]";
                $con = new $conName();
                $con->{$action[1]}();
                return;
            }
        }
    }
}