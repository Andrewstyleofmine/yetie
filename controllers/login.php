<?php
require_once('../init.php');

    $for_query = [];
    $title = "Вход";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];
        // $errors["lot-name"] = "Заполните это поле"
        $required_fields = [
            "email",
            "password",


        ];

        $for_query = [];
        foreach ($_POST as $key => $value) {
            if (in_array($key, $required_fields) && !$value) {
                $errors[$key] = "Заполните это поле";

            }
            elseif ($key == "email" and $value) {
                $email_require = filter_var($value, FILTER_VALIDATE_EMAIL);
                if ($email_require == false) {
                    $errors[$key] = "Email введён некорректно";
                }
                else {
                    $for_query[$key] = $value;
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

    if (count($for_query) == 2) {
        $requireSQL = "SELECT email, password, avatar, username FROM users WHERE email = ?";
        $require = make_query($con, $requireSQL, [$for_query['email']]);
        if (password_verify($for_query['password'], $require[0]['password']))
        {
            session_start();

            $_SESSION['avatar'] = $require[0]['avatar'];
            $_SESSION['user_name'] = $require[0]['username'];
            header("location: http://yetie-l/");

        } else {
            $errors['incorrect'] = "Логин или пароль введены некорректоно";
        }


    }
    $loginHTML = renderTemplate('login.php', [
        "errors" => $errors
    ]);

    $header_block = renderTemplate("secondary_header_block.php", [
        'categories' => $categories,

    ]);
    $indexContent = renderTemplate('layout.php', [
        "content" => $loginHTML,
        'title' => $title,
        'categories' => $categories,
        "header_block" => $header_block


    ]);
    print($indexContent);




