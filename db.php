<?php
require_once  ('helpers.php');
require_once  ('functions.php');

$con = mysqli_connect('localhost', 'root', '', 'yeti');
$lotsSQL = "SELECT  l.id, l.expire_date, l.title, l.winner_id,  l.description, l.start_price, l.image_url, c.title as category
FROM lots l JOIN categories c ON l.category_id = c.id";
$lots = make_query($con, $lotsSQL);

foreach ($lots as $lot) {
    $lot_id = $lot['id'];
    $expire_date = $lot['expire_date'];
    $winner = "SELECT user_id FROM bets WHERE lot_id = {$lot_id} ORDER BY bet_price DESC LIMIT 1";
    $sql_update = "UPDATE lots SET winner_id = ({$winner}) WHERE id = {$lot_id}";
    $sql_event = "CREATE EVENT lot_{$lot_id}_winner ON SCHEDULE AT '{$expire_date}' DO {$sql_update}";
    mysqli_query($con, $sql_event);
}

if (!$con) {

    die ("Ошибка подключения: ".mysqli_connect_error());
}
else {
    mysqli_set_charset($con, "utf8");
}

