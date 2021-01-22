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

        $fund = DB::fetch("SELECT * FROM funds WHERE fund_num = ?", [$fund_num]);
        $investors = DB::fetchAll("SELECT * FROM investors WHERE fund_num = ?", [$fund_num]);

        view("detail", compact("fund", "investors"));
    }

    function viewPage() {
        $funds = DB::fetchAll("SELECT * FROM funds");
        $funds = pagenation($funds);

        view("view", compact("funds"));
    }

    function insertInvest() {
        extract($_POST);

        $investor = DB::fetch("SELECT * FROM investors WHERE email = ? AND fund_num = ?", [user()->user_email, $invest_num]); 
        
        if($investor) {
            DB::query("UPDATE investors SET pay = ? WHERE email = ? AND fund_num = ?", [$investor->pay + $fund_price, user()->user_email, $invest_num]);
        }
        else {
            DB::query("INSERT INTO investors(fund_num, fund_name, name, email, pay, sign, datetime) VALUES(?, ?, ?, ?, ?, ?, ?)", [$invest_num, $invest_name, user()->user_name, user()->user_email, $fund_price, $sign, date("Y-m-d H-i-s")]);
        } 
        
        $fund = DB::fetch("SELECT fund_total, fund_current FROM funds WHERE fund_num = ?", [$invest_num]);
        $current = (int)$fund->fund_current + (int)$fund_price;
        $total = (int)$fund->fund_total;

        $success = round(($current / $total) * 100, 1);
        
        DB::query("UPDATE funds SET fund_current = ?, fund_success = ? WHERE fund_num = ?", [$current, $success, $invest_num]);
        DB::query("UPDATE users SET money = ? WHERE id = ?", [user()->money - $fund_price, user()->id]);
        $_SESSION["user"] = DB::who(user()->user_email);

        go("/view", "투자가 완료되었습니다.");
    }

    function insertBusiness() {
        extract($_POST);
        
        DB::query("INSERT INTO business(user_email, business_name) VALUES(?, ?)", [user()->user_email, $fund_name]);

        $fund = DB::fetch("SELECT fund_current FROM funds WHERE fund_num = ?", [$fund_num]);

        DB::query("UPDATE users SET money = ? WHERE id = ?", [user()->money + $fund->fund_current, user()->id]);

        DB::query("DELETE FROM funds WHERE fund_num = ?", [$fund_num]);
        $_SESSION["user"] = DB::who(user()->user_email);
        
        go("/view", "사업 추가가 완료되었습니다.");
    }

    function registerPage() {
        view("register");
    }

    function insertFund() {
        extract($_POST);
        $fund_endDate = $fund_endDate . " " . $fund_endDate_time;
        
        DB::query("INSERT INTO funds(fund_num, fund_name, fund_endDate, fund_total, owner) 
                   VALUES(?, ?, ?, ?, ?)", [$fund_num, $fund_name, $fund_endDate, $fund_total, user()->user_email]);
        
        go("/view", "등록이 완료되었습니다.");
    }

    function deleteFund() {
        extract($_POST);

        $investors = DB::fetchAll("SELECT I.pay, I.email FROM investors I
                                WHERE I.fund_num = ?", [$fund_num]);

        foreach($investors as $investor) {
            DB::query("UPDATE users SET money = money + ? WHERE user_email = ?", [$investor->pay, $investor->email]);
        }
        
        DB::query("DELETE FROM funds WHERE fund_num = ?", [$fund_num]);

        go("/admin", "펀드가 해제되었습니다.");
    }

    function investorPage() {
        extract($_GET);
        
        $order = isset($order) ? $order : "fund_name";

        $investors = DB::fetchAll("SELECT * FROM investors ORDER BY $order DESC");
    
        $investors = pagenation($investors);

        view("investor", compact("investors", "order"));
    }
}