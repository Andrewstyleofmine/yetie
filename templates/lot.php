

<section class="lot-item container">
    <h2><?= $lot['title']?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?php echo '../'.$lot['image_url']?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?php echo $lot['category'] ?></span></p>
            <p class="lot-item__description"> <?php echo $lot['description']?></p>
        </div>
        <div class="lot-item__right">

                <div class="lot-item__state">
                    <?php if (count_time($lot["expire_date"]) != "Торги окончены"): ?>
                        <div class="lot-item__timer timer timer--finishing">
                            <?php echo count_time($lot["expire_date"]) ?>
                        </div>
                    <?php else: ?>
                        <div class="item__timer timer timer--end">
                            <?php echo count_time($lot["expire_date"]) ?>
                        </div>
                    <?php endif;?>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?php echo format_price($lot['start_price']) ?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span><?php echo number_format($lot['bet_step'] + $lot['start_price'],0,'.', ' ').' р'?></span>
                        </div>
                    </div>
            <?php session_start(); if(isset($_SESSION['user_name']) and  count_time($lot["expire_date"]) != "Торги окончены" and $is_show):?>
                    <form class="lot-item__form" action="" method="post" autocomplete="off">
                        <p class="lot-item__form-item form__item <?php echo (!empty($error)) ? "form__item--invalid" : "" ?>">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="text" name="cost" placeholder="<?php echo number_format($lot['bet_step'] + $lot['start_price'],0,'.', ' ').' р'?>">
                            <span class="form__error"><?php echo (!empty($error)) ? $error : "" ?></span>
                        </p>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
            <?php endif;?>

                </div>
            <div class="history">
                <h3>История ставок (<span><?= count($all_bets) ?></span>)</h3>

                    <table class="history__list">


                            <?php foreach ($all_bets as $bet): ?>
                                <tr class="history__item">
                                    <td class="history__name"><?php echo $bet['username']?></td>
                                    <td class="history__price"><?php echo number_format($bet['bet_price'], 0,'.', ' ').' р'?></td>
                                    <td class="history__time"><?php echo $bet['bet_date']?></td>
                                </tr>
                            <?php endforeach; ?>



                    </table>

            </div>
        </div>
    </div>
</section>
