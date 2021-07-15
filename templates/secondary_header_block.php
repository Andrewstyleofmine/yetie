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
       <?php session_start(); if(isset($_SESSION['user_name'])):?>

                <a class="main-header__add-lot button" href="../add-lot">Добавить лот</a>
                <nav class="user-menu">
                    <div class="user-menu__logged">
                        <p><?php echo $_SESSION['user_name'] ?></p>
                        <a class="user-menu__bets user-menu" href="../my-bets">Мои ставки</a>
                        <a class="user-menu__logout" href="../logout">Выход</a>
                    </div>
                </nav>
            </div>
        <?php else: ?>


            <ul class="user-menu__list">
                <li class="user-menu__item"> <a href="../sign-up">Регистрация</a> </li>
                <li class="user-menu__item"> <a href="../login">Вход</a> </li>
            </ul>
        <?php endif;?>
    </header>

<nav class="nav">
    <ul class="nav__list container">
        <?php foreach($categories as $category): ?>
            <li class="nav__item">
                <a href="../all-lots/<?php echo $category['id']?>"><?php echo $category['title']?></a>
            </li>
        <?php endforeach; ?>
    </ul>

</nav>
