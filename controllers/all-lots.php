`<?php
    require_once('../init.php');

    $title = 'Все лоты';
    $category_id = $_GET['id'];
    $found_lotsSQL = "SELECT  l.id, l.title, l.expire_date, l.description, l.start_price, l.image_url, c.title as category
    FROM lots l JOIN categories c ON l.category_id = c.id WHERE c.id = ?";

    $found_lots = make_query($con, $found_lotsSQL, [$category_id]);

    if (!empty($found_lots)) {
        $category_title = $found_lots[0]['category'];

        $lotHTML = renderTemplate('all-lots.php', [
            'found_lots' => $found_lots,
            'category_title' => $category_title
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

