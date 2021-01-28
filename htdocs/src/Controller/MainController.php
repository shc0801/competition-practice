<?php

namespace Controller;

use App\DB;

class MainController {
    function indexPage() {
        $funds = DB::fetchAll("SELECT * FROM funds ORDER BY fund_success DESC LIMIT 4");

        view("index", compact("funds"));
    }

    function viewPage() {
        $funds = DB::fetchAll("SELECT * FROM funds");
        $funds = pagenation($funds);

        view("view", compact("funds"));
    }

    function registerPage() {
        view("register");
    }

    function insertFund() {
        extract($_POST);

        DB::query("INSERT INTO funds(fund_num, fund_name, fund_endDate, fund_total, owner) VALUES(?, ?, ?, ?, ?)", [$fund_num, $fund_name, $fund_endDate, $fund_price, user()->user_email]);

        go("/", "펀드가 등록되었습니다.");
    }

    function investorPage() {
        view("investor");
    }

    function detailPage() {
        extract($_POST);
        var_dump($_POST);

        $fund = DB::fetch("SELECT * FROM funds WHERE fund_num = ?", [$fund_num]);
        // $fund = DB::fetchAll("SELECT * FROM investors WHERE ")

        view("detail", compact("fund", "investors"));
    }
}