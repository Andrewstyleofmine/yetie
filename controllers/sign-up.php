<?php

    require_once('../init.php');

    $title = 'Регистрация';
    $for_query = [];
$errors = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // $errors["lot-name"] = "Заполните это поле"
        $required_fields = [
            "email",
            "password",
            "name",
            "message"

        ];
        $for_query = [];
        foreach ($_POST as $key => $value) {
            if (in_array($key, $required_fields) && !$value) {
                $errors[$key] = "Заполните это поле";
            }
            elseif (in_array($key, $required_fields) && $value && preg_match('/\<(.*?)\>/', $value)) {

                $errors[$key] = "Введены некорректные символы (ввод конструкций тэгов запрщён)";
            }
            elseif ($key == "email" and $value) {
                $email_require = filter_var($value,FILTER_VALIDATE_EMAIL );
                if ($email_require == false) {
                    $errors[$key] = "Email введён некорректно";
                } else {
                    $search_both_emailSQL = "SELECT email FROM users where email = ?";
                    $search_both_email = make_query($con, $search_both_emailSQL, [$value]);
                    if ($search_both_email[0]['email'] != "") {
                        $errors[$key] = "Такой email уже существует";
                    }
                    else {
                        $for_query[$key] = $value;
                    }
                }
             }
            elseif ($key == "password" and $value) {
                if (preg_match('/^[A-z0-9]{4,30}$/', $value)  == 0) {
                    $errors[$key] = "Пароль введён некорректно (используйте латиницу и числа)";
                }
                else {
                    $for_query[$key] = $value;
                }
            }
            else {
                $for_query[$key] = $value;
            }
        }
    }
    if (count($for_query) == 4) {
        $for_query['reg_date'] = date('Y-m-d H:i:s');
        $for_query['password'] = password_hash($for_query['password'], PASSWORD_DEFAULT);
        $regSQL = "INSERT INTO users (username, email, password, avatar, reg_date, contacts)
            VALUES (?, ?,?,'img/avatar.jpg',?,?)";
        make_insert_query($con, $regSQL, [$for_query['name'], $for_query['email'], $for_query['password'], $for_query['reg_date'], $for_query['message']]);
        header("location: http://yetie-l/login");


    }
    $sign_upHTML = renderTemplate('sign-up.php', [
        "errors" => $errors

    ]);

    $header_block = renderTemplate("secondary_header_block.php", [
        'categories' => $categories,

    ]);
    $indexContent = renderTemplate('layout.php', [
        "content" => $sign_upHTML,
        'title' => $title,
        'categories' => $categories,
        "header_block" => $header_block


    ]);
    print($indexContent);
