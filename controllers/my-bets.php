<?php
require_once('../init.php');
if (!empty($_SESSION['user_name'])) {
    $title = 'Мои ставки';
    $user_betsSQL = "SELECT l.id as lot_id, l.title, l.image_url,l.winner_id, c.title as category, l.expire_date, b.bet_price, b.bet_date, b.user_id  FROM categories AS c JOIN lots AS l ON c.id = l.category_id JOIN bets AS b ON l.id = b.lot_id
JOIN users AS u ON b.user_id = u.id WHERE b.user_id = ?";
    $user_bets = make_query($con, $user_betsSQL, [$user_id]);
    $get_contacts_arr = [];
    if (empty($user_bets)) {
        $error_title = "403 Ставки не найдены";
        $error_description = "Вами не было сделано ни одной ставки.";
        $betsHTML = renderTemplate('message.php', [
            "error_title" => $error_title,
            "error_description" => $error_description
        ]);
    }
    else {
        foreach ($user_bets as $user_bet) {
            if ($user_bet['winner_id'] != NULL) {
                $get_contactsSQL = "SELECT contacts FROM lots JOIN users ON lots.user_id = users.id WHERE lots.id = ?";
                $get_contacts = make_query($con, $get_contactsSQL, [$user_bet['lot_id']]);
                $get_contacts_arr[$user_bet['lot_id']] = $get_contacts[0]['contacts'];

            }
        }
        $betsHTML = renderTemplate('my-bets.php', [
            "user_bets" => $user_bets,
            "all_bets" => $all_bets,
            "get_contacts_arr" => $get_contacts_arr

        ]);
    }

}
    elseif(empty($_SESSION['user_name'])) {
        $error_title = "403 Страница не доступна";
        $error_description = "Необходимо авторизоваться, чтобы получить доступ к странице.";
        $betsHTML = renderTemplate('message.php', [
            "error_title" => $error_title,
            "error_description" => $error_description
        ]);
    }
    $header_block = renderTemplate("secondary_header_block.php", [
        'categories' => $categories,

    ]);
    $indexContent = renderTemplate('layout.php', [
        "content" => $betsHTML,
        'title' => $title,
        'categories' => $categories,
        "header_block" => $header_block


    ]);
    print($indexContent);


