<?php

namespace Controller;

use App\DB;

class MainController {
    function indexPage() {
        $funds = DB::fetchAll("SELECT * FROM funds ORDER BY fund_success DESC LIMIT 4");

        view("index", compact("funds"));
    }

    function detailPage() {
        extract($_POST);

        $funds = DB::fetchAll("SELECT * FROM funds WHERE fund_num = ?", [$fund_num]);
        $investors = DB::fetchAll("SELECT * FROM investors WHERE fund_num = ?", [$fund_num]);

        view("detail", compact("funds", "investors"));
    }

    function viewPage() {
        $funds = DB::fetchAll("SELECT * FROM funds");
        $funds = pagenation($funds);

        view("view", compact("funds"));
    }

    function insertInvest() {
        extract($_POST);

        $investors = DB::fetch("SELECT * FROM investors WHERE email = ? AND fund_num = ?", [user()->user_email, $fund_num]);

        if($investors) {
            DB::query("UPDATE investors SET pay = ? WHERE email = ? AND fund_num = ?", [$investors->pay + $fund_price, user()->user_email, $fund_num]);
        } else {
            DB::query("INSERT INTO investors(fund_num, fund_name, name, email, pay, sign, datetime) VALUES(?, ?, ?, ?, ?, ?, ?)", [$fund_num, $fund_name, user()->user_name, user()->user_email, $fund_price, $fund, $sign, date("Y-m-d H-i-s")]);
        }
        
        $fund = DB::fetch("SELECT fund_total, fund_current FROM funds WHERE fund_num = ?", [$fund_num]);
    }
}