        <form class="form container <?php echo (count($errors) != 0 ) ? "form--invalid" : ""?>" action="" method="post" autocomplete="off"> <!-- form
    --invalid -->
            <h2>Регистрация нового аккаунта</h2>
            <div class="form__item <?php echo (isset($errors["email"])) ? "form__item--invalid" : "" ?>">
                <label for="email">E-mail <sup>*</sup></label>
                <input id="email" type="text" name="email" placeholder="Введите e-mail">
                <span class="form__error"><?php echo (isset($errors["email"])) ? $errors["email"] : "" ?></span>
            </div>
            <div class="form__item <?php echo (isset($errors["password"])) ? "form__item--invalid" : "" ?>">
                <label for="password">Пароль <sup>*</sup></label>
                <input id="password" type="password" name="password" placeholder="Введите пароль">
                <span class="form__error"><?php echo (isset($errors["password"])) ? $errors["password"] : "" ?></span>
            </div>
            <div class="form__item <?php echo (isset($errors["name"])) ? "form__item--invalid" : "" ?>">
                <label for="name">Имя <sup>*</sup></label>
                <input id="name" type="text" name="name" placeholder="Введите имя">
                <span class="form__error"><?php echo (isset($errors["name"])) ? $errors["name"] : "" ?></span>
            </div>
            <div class="form__item <?php echo (isset($errors["message"])) ? "form__item--invalid" : "" ?>">
                <label for="message">Контактные данные <sup>*</sup></label>
                <textarea id="message" name="message" placeholder="Напишите как с вами связаться"></textarea>
                <span class="form__error "><?php echo (isset($errors["message"])) ? $errors["message"] : "" ?></span>
            </div>
            <span class="form__error <?php echo (isset($errors)) ? "form__error--bottom" : "" ?> "><?php echo (isset($errors)) ? "Пожалуйста, исправьте ошибки в форме." : "" ?> </span>
            <button type="submit" class="button">Зарегистрироваться</button>
            <a class="text-link" href="../login">Уже есть аккаунт</a>
        </form>


