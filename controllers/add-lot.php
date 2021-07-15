<?php

require_once('../init.php');

session_start();
$title = "Добавить лот";
$errors = [];
$for_query = [];

if (empty($_SESSION['avatar'])) {
    $error_title = "403 Доступ запрещен";
    $error_description = "Анонимные пользователи не имеют возможность добалять лот";
    $page_content = renderTemplate("message.php", [
            "error_title" => $error_title,
            "error_description" => $error_description
        ]
    );
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $required_fields = [
            "lot-name",
            "category",
            "message",
            "lot-rate",
            "lot-step",
            "lot-date"
        ];
        $required_num_fields = [
            "lot-rate",
            "lot-step"
        ];
        foreach ($_POST as $key => $value) {
            if (in_array($key, $required_fields) && !$value) {
                $errors[$key] = "Заполните это поле";
            } elseif (in_array($key, $required_fields) && $value && preg_match('/\<(.*?)\>/', $value)) {
                $errors[$key] = "Введены некорректные символы (ввод конструкций тэгов запрщён)";
            } elseif ($key == "category" and $value == "Выберите категорию") {
                $errors['category'] = "Выберите категорию";
            } elseif (in_array($key, $required_num_fields) && $value && !ctype_digit($value)) {
                $errors[$key] = "Введи число больше 0";
            } else {
                $for_query[$key] = $value;
            }
        }
        if ($_FILES["photo"]["size"] == 0 or $_FILES["photo"]["type"] != "image/jpeg") {
            $errors["photo"] = "Загрузите файл";
        } else {
            if ($_FILES["photo"]["type"] == "image/jpeg" and count($errors) == 0) {
                $file_name = $_FILES["photo"]["name"];
                $path = "../img/{$file_name}";
                move_uploaded_file($_FILES["photo"]["tmp_name"], $path);
                $for_query['image_url'] = '../img/' . $_FILES["photo"]['name'];
            }
        }
        if (empty(strtotime($_POST['lot-date']))) {
            $errors['lot-date'] = "Введите дату завершения торгов";
        } else {
            $date = $_POST['lot-date'];
            if (strtotime($date) <= mktime(0, 0, 0, date('m'), date('d'))) {
                $errors['lot-date'] = "Введённая дата меньше текущей даты";
            }
        }
    }
        if (count($for_query) == 7) {
                $for_query['date_create'] = date('Y-m-d H:i:s');
                $for_query['expire-date'] = $date .' '.date('H:i:s');
                $category_idSQL = "SELECT id FROM categories WHERE title = ?";
                $category_id = make_query($con, $category_idSQL, [$_POST["category"]]);
                $category_id = $category_id[0]['id'];
                $add_lotSQL = "INSERT INTO `lots` (`title`, `description`, `start_price`, `image_url`, `date_create`, `expire_date`, `bet_step`, `user_id`, `category_id`, `winner_id`) VALUES (?,?,?,?,?,?,?,?,?, NULL)";
                make_insert_query($con, $add_lotSQL, [
                    $for_query["lot-name"],
                    $for_query["message"],
                    $for_query["lot-rate"],
                    $for_query["image_url"],
                    $for_query["date_create"],
                    $for_query["expire-date"],
                    $for_query["lot-step"],
                    $user_id,
                    $category_id]
                    );
                $all_lotsSQL = "SELECT * FROM lots";
                $lot_id = make_query($con, $all_lotsSQL);
                $lot_id = $lot_id[count($lot_id) - 1]['id'];
                header("location: http://yetie-l/lot/{$lot_id}");
            }
        }

    $header_block = renderTemplate("secondary_header_block.php", [
        'categories' => $categories,

    ]);
    $page_content = renderTemplate("add-lot.php", [
        "errors" => $errors
    ]);


    $page_menu = renderTemplate("layout.php", [
        "categories" => $categories,
        "content" => $page_content,
        'title' => $title,
        "header_block" => $header_block

    ]);
    print($page_menu);

echo ($_FILES["photo"]["type"]);
