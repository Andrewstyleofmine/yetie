<?php
    require_once('functions.php');
    $title = '404';
    $indexHTML = renderTemplate('message.php');
    $indexContent = renderTemplate('menu.php', [
        "content" => $indexHTML,
        'title' => $title


    ]);
    print($indexContent);
