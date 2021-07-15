
<form class="form container <?php echo (count($errors) != 0 ) ? "form--invalid" : ""?>" action="" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <?php echo (isset($errors["email"])) ? "form__item--invalid" : "" ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail">
        <span class="form__error"><?php echo (isset($errors["email"])) ? $errors["email"] : "" ?></span>
    </div>
    <div class="form__item form__item--last <?php echo (isset($errors["password"])) ? "form__item--invalid" : "" ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль">
        <span class="form__error"><?php echo (isset($errors["password"])) ? $errors["password"] : "" ?></span>
    </div>
    <button type="submit" class="button">Войти</button>
    <span class="form__error <?php echo (isset($errors)) ? "form__error--bottom" : "" ?> "><?= (isset($errors["incorrect"])) ? $errors["incorrect"] : "" ?> </span>
</form>




