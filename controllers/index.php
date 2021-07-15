<?php
require_once('../init.php');
//SELECT  b.user_id, b.bet_date, l.title
//FROM lots l JOIN bets b ON l.id = b.lot_id WHERE  NOW() > l.expire_date

$title = "Главная";

$header_block = renderTemplate("index_header_block.php", [
    'categories' => $categories,

]);

$indexHTML = renderTemplate('index.php', [
    'lots' => $lots,

]);

$indexContent = renderTemplate('layout.php', [
    "header_block" => $header_block,

    "content" => $indexHTML,
    'title' => $title,
    'categories' => $categories,


]);
print($indexContent);


