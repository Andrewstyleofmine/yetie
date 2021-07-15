<div class="container">
    <section class="lots">
        <?php if (!empty($input_value)):?>
            <h2>Результаты поиска по запросу «<span><?php echo $input_value?></span>»</h2>
        <?php elseif (empty($input_value)):?>
            <h2>Все лоты</h2>
        <?php endif; ?>
        <ul class="lots__list">
            <?php foreach ($search_lots as $search_lot): ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?php echo $search_lot['image_url']?>" width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?php echo $search_lot['category']?></span>
                        <h3 class="lot__title"><a class="text-link" href="../lot/<?php echo $search_lot['id']?>"><?php echo $search_lot['title']?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?php echo format_price($search_lot['start_price'])?></span>
                            </div>
                            <?php if (count_time($search_lot["expire_date"]) != "Торги окончены"): ?>
                                <div class="lot__timer timer timer--finishing">
                                    <!--Время-->
                                    <?php echo count_time($search_lot["expire_date"]); ?>
                                </div>
                            <?php else: ?>
                                <div class="lot__timer timer timer--end">
                                    <!--Время-->
                                    <?php echo count_time($search_lot["expire_date"]); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
</div>
