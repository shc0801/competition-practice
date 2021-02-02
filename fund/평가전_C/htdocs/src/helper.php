<?php

function go($url, $msg = "") {
    echo "<script>";
    echo "alert('$msg');";
    echo "location.href = '$url';";
    echo "</script>";
    exit;
}

function back($msg = "") {
    echo "<script>";
    echo "alert('$msg');";
    echo "history.back();";
    echo "</script>";
    exit;
}

function view($viewName, $data = []) {
    extract($data);
    require_once VIEW."/header.php";
    require_once VIEW."/$viewName.php";
    require_once VIEW."/footer.php";
    exit;
}

function user() {
    return isset($_SESSION["user"]) ? $_SESSION["user"] : false;
}

function admin() {
    return user()->user_email == "admin" ? $_SESSION["user"] : false;
}

function pagenation($data) {
    define("LIST_LENGTH", 10);
    define("BLOCK_LENGTH", 5);
    define("SPACING", 4);
    
    $page = isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] >= 1 ? $_GET["page"] : 1;

    $totalPage = ceil(count($data) / LIST_LENGTH);
    
    $startPage = floor($page / BLOCK_LENGTH) * BLOCK_LENGTH + 1;
    $endPage = $startPage + SPACING > $totalPage ? $totalPage : $startPage + SPACING;

    $next = true;
    $prev = true;

    if($startPage == 1) $next = false;
    if($endPage == $totalPage) $prev = false;

    $data = array_slice($data, ($page - 1) * LIST_LENGTH, LIST_LENGTH);

    return (object)compact("startPage", "endPage", "data", "next", "prev");
}