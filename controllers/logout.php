<?php
session_start();
if (isset($_SESSION['avatar'])) {
    unset($_SESSION['avatar']);
    unset($_SESSION['user_name']);
}
header("location: http://yetie-l/");

