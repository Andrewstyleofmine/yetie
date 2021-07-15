<?php
    require_once('init.php');
    $title = 'Все лоты';
    $category_title = $_GET['category'];

    $categoriesSQL = "SELECT * FROM categories";
    $found_lotsSQL = "SELECT  l.id, l.title, l.description, l.start_price, l.image_url, c.title as category
    FROM lots l JOIN categories c ON l.category_id = c.id WHERE c.title = '$category_title'";

    $categories = make_query($con, $categoriesSQL);
    $found_lots = make_query($con, $found_lotsSQL);
    if (!empty($found_lots)) {
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
    $indexContent = renderTemplate('menu.php', [
        "content" => $lotHTML,
        'title' => $title,
        'categories' => $categories


         ]);
    print($indexContent);

