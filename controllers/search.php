<?php
require_once('../init.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $input_value = trim($_GET["search"], " ");
    if (!empty($input_value)) {

        $search_lots_sql = "SELECT  l.id, l.expire_date, l.title, l.winner_id,  l.description, l.start_price, l.image_url, c.title as category
FROM lots l JOIN categories c ON l.category_id = c.id WHERE  l.title LIKE ? or  l.description LIKE ?";
        $search_lots = make_query($con, $search_lots_sql, ["%$input_value%", "%$input_value%"]);
    } else {
        $search_lots_sql = "SELECT  l.id, l.expire_date, l.title, l.winner_id,  l.description, l.start_price, l.image_url, c.title as category
FROM lots l JOIN categories c ON l.category_id = c.id";
        $search_lots = make_query($con, $search_lots_sql);
    }
    if (count($search_lots) > 0) {
        $page_content = renderTemplate('search.php', [
            'search_lots' => $search_lots,
            'input_value' => $input_value

        ]);
    }
    else {
        $error_title = "404 Не найдено";
        $error_description = "Не было найдено ни одного лота";
        $page_content = renderTemplate("message.php", [
                "error_title" => $error_title,
                "error_description" => $error_description
            ]
        );
    }
}
    $header_block = renderTemplate("secondary_header_block.php", [
        'categories' => $categories,

    ]);
    $indexContent = renderTemplate('layout.php', [
        "content" => $page_content,
        'title' => $title,
        'categories' => $categories,
        "header_block" => $header_block


    ]);
    print($indexContent);

