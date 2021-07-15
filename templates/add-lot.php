
<form class="form form--add-lot container <?php echo (count($errors) != 0 ) ? "form--invalid" : ""?>" action="" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?php echo (isset($errors["lot-name"])) ? "form__item--invalid" : "" ?>"> <!-- form__item--invalid -->
            <label for="lot-name">Наименование <sup>*</sup></label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота">
            <span class="form__error"><?php echo (isset($errors["lot-name"])) ? $errors["lot-name"] : "" ?></span>
        </div>
        <div class="form__item <?php echo (isset($errors["category"])) ? "form__item--invalid" : "" ?>">
            <label for="category">Категория <sup>*</sup></label>
            <select id="category" name="category">
                <option>Выберите категорию</option>
                <option>Доски и лыжи</option>
                <option>Крепления</option>
                <option>Ботинки</option>
                <option>Одежда</option>
                <option>Инструменты</option>
                <option>Разное</option>
            </select>
            <span class="form__error">Выберите категорию</span>
        </div>
    </div>
    <div class="form__item form__item--wide <?php echo (isset($errors["message"])) ? "form__item--invalid" : "" ?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"></textarea>
        <span class="form__error"><?php echo (isset($errors["message"])) ? $errors["message"] : "" ?></span>
    </div>
    <div class="form__item form__item--file <?php echo (isset($errors["photo"])) ? "form__item--invalid" : "" ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot-img" value="" name="photo">
            <label for="lot-img">
                Добавить
            </label>
        </div>
        <span class="form__error"><?php echo (isset($errors["photo"])) ? $errors["photo"] : "" ?></span>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small <?php echo (isset($errors["lot-rate"])) ? "form__item--invalid" : "" ?>">
            <label for="lot-rate">Начальная цена <sup>*</sup></label>
            <input id="lot-rate" type="text" name="lot-rate" placeholder="0">
            <span class="form__error"><?php echo (isset($errors["lot-rate"])) ? $errors["lot-rate"] : "" ?></span>
        </div>
        <div class="form__item form__item--small <?= (isset($errors["lot-step"])) ? "form__item--invalid" : "" ?>">
            <label for="lot-step">Шаг ставки <sup>*</sup></label>
            <input id="lot-step" type="text" name="lot-step" placeholder="0">
            <span class="form__error"><?php echo (isset($errors["lot-step"])) ? $errors["lot-step"] : "" ?></span>
        </div>
        <div class="form__item <?php echo (isset($errors["lot-date"])) ? "form__item--invalid" : "" ?>">
            <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <span class="form__error"><?php echo (isset($errors["lot-date"])) ? $errors["lot-date"] : "" ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>


