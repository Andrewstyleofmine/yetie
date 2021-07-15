<?php


require_once ('db.php');
session_start();
$categoriesSQL = "SELECT * FROM categories";
$categories = make_query($con, $categoriesSQL);
$get_user_idSQL = "SELECT id FROM users WHERE username = ?";
$user_id = make_query($con, $get_user_idSQL, [$_SESSION['user_name']]);
$user_id = $user_id[0]['id'];
