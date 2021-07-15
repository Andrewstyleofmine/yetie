<?php
require_once('../init.php');
session_start();
$lot_id = intval($_GET["id"]);
$lotSQL = "SELECT  l.expire_date, l.winner_id, l.user_id, l.bet_step, l.id, l.title, l.description, l.start_price, l.image_url, c.title as category
    FROM lots l JOIN categories c ON l.category_id = c.id WHERE l.id = ?";
$lot = make_query($con, $lotSQL, [$lot_id]);
$error = "";
$is_show = true;


$bet_user_idSQL = "SELECT user_id FROM bets WHERE lot_id = ? and user_id = ?";
$bet_user_id = make_query($con, $bet_user_idSQL,[$lot_id, $user_id]);

$find_winner_nameSQL = "SELECT username FROM users WHERE id = ?";
$find_winner_name = make_query($con, $find_winner_nameSQL, [$lot[0]['winner_id']])[0]['username'];
if (!empty($bet_user_id)) {
    $is_show = false;
}
if ($user_id == $lot[0]['user_id']) {
    $is_show = false;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['cost'])) {
        $error = "Введите ставку";
    }
    elseif (!ctype_digit($_POST['cost'])) {
        $error = "Введи число больше 0";
    }
    elseif ($_POST['cost'] < $lot[0]['bet_step'] + $lot[0]['start_price']) {
        $error = "Ставка не может быть меньше минимальной ставки с учётом шага";
    }

    elseif (!empty($_POST['cost']) and ctype_digit($_POST['cost']) and $_POST['cost'] > $lot[0]['bet_step'] + $lot[0]['start_price'] and $is_show) {
        $bet_date = date('Y-m-d H:i:s');
        $add_betSQL = "INSERT INTO bets (bet_date, bet_price, user_id, lot_id) VALUES 
            (?, ?, ?, ?)";
        make_insert_query($con, $add_betSQL, [$bet_date, $_POST['cost'], $user_id, $lot_id]);
        $is_show = false;

    }

}
    //Записываем в COOKIE
    if (empty($_COOKIE['lot_id'])) {
        $arr[] = $lot_id;
        $cookieValue = serialize($arr);
        setcookie('lot_id', $cookieValue, time() + 60*60*60, "/");
    }
    else {
        $tmp = unserialize($_COOKIE['lot_id']);
        $tmp[] = $lot_id;

        $cookieValue= serialize($tmp);
        setcookie('lot_id', $cookieValue, time() + 60*60*60, "/");
    }
    $betsSQL = "SELECT  u.username, b.id, b.bet_date, b.bet_price
    FROM users u JOIN bets b ON u.id = b.user_id WHERE b.lot_id = ?";
    $all_bets = make_query($con, $betsSQL, [$lot_id]);
    $title = $lot[0]['title'];

    if (!empty($lot)) {
        $lotHTML = renderTemplate('lot.php', [
            "lot" => $lot[0],
            'all_bets' => $all_bets,
            "error" => $error,
            "is_show" => $is_show,
        ]);
    } else {
        $error_title = "404 Страница не найдена";
        $error_description = "Данной страницы не существует на сайте.";
        $lotHTML = renderTemplate('message.php', [
            "error_title" => $error_title,
            "error_description" => $error_description
        ]);
    }


    $header_block = renderTemplate("secondary_header_block.php", [
        'categories' => $categories,

    ]);
    $indexContent = renderTemplate('layout.php', [
        "content" => $lotHTML,
        'title' => $title,
        'categories' => $categories,
        "header_block" => $header_block


    ]);
    print($indexContent);
