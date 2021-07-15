

<header class="main-header">
    <div class="main-header__container container">
        <h1 class="visually-hidden">YetiCave</h1>
        <a class="main-header__logo" href="../">
            <img src="../img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
        </a>
        <form class="main-header__search" method="get" action="../search" autocomplete="off">
            <input type="search" name="search" placeholder="Поиск лота">
            <input class="main-header__search-btn" type="submit" name="find" value="Найти">
        </form>
        <?php session_start(); if(isset($_SESSION['avatar'])):?>
        <a class="main-header__add-lot button" href="../add-lot">Добавить лот</a>

        <nav class="user-menu">

            <!-- здесь должен быть PHP код для показа меню и данных пользователя -->

            <div class="user-menu__image">
                <img src="../<?php echo $_SESSION['avatar']?>" width="40" height="40" alt="Пользователь">
            </div>
            <div class="user-menu__logged">
                <p><?php echo $_SESSION['user_name']?></p>
                <a href="../logout">Выйти</a>
            </div>
            <?php else: ?>


                <ul class="user-menu__list">
                    <li class="user-menu__item"> <a href="../sign-up">Регистрация</a> </li>
                    <li class="user-menu__item"> <a href="../login">Вход</a> </li>
                </ul>
            <?php endif;?>

        </nav>
    </div>
</header>

<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php foreach ($categories as $category): ?>
                <li class="promo__item <?php echo 'promo__item--'.$category['alias']?>">
                    <a class="promo__link" href="../all-lots/<?php echo $category['id'] ?>"><?php echo $category['title']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

