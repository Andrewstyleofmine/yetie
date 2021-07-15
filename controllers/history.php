<?php
require_once('../init.php');
session_start();
$title = "История лотов";
if (!empty($_COOKIE['lot_id'])) {

    $got_id_array = array_unique(unserialize($_COOKIE['lot_id']));
    $string_for_query = implode(', ', $got_id_array);
    $historySQL = "SELECT  l.id, l.expire_date, l.title, l.description, l.start_price, l.image_url, c.title as category
    FROM lots l JOIN categories c ON l.category_id = c.id WHERE l.id IN ({$string_for_query})";
    $history = make_query($con, $historySQL);

    $historyHTML = renderTemplate('history.php', [
        "history" => $history

    ]);
}
else {
    $error_title = "Лоты не найдены";
    $error_description = "Вами не было просмотрено ни одного лота.";
    $historyHTML = renderTemplate('message.php', [
        "error_title" => $error_title,
        "error_description" => $error_description
    ]);
}
    $header_block = renderTemplate("secondary_header_block.php", [
        'categories' => $categories,

    ]);
    $indexContent = renderTemplate('layout.php', [
        "content" => $historyHTML,
        'title' => $title,
        'categories' => $categories,
        "header_block" => $header_block


    ]);
    print($indexContent);
