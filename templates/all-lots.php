
        <div class="container">
            <section class="lots">

                    <h2>Все лоты в категории <span><?php echo $category_title?></span></h2>
                    <ul class="lots__list">
                        <?php foreach ($found_lots as $found_lot) :?>

                                <!--заполните этот список из массива с товарами-->
                                <li class="lots__item lot">
                                    <div class="lot__image">
                                        <img src="<?php echo '../'.$found_lot['image_url']?>" width="350" height="260" alt="">
                                    </div>
                                    <div class="lot__info">
                                        <span class="lot__category"><?php echo  $found_lot['category']?></span>
                                        <h3 class="lot__title"><a class="text-link" href="../lot/<?php echo  $found_lot['id']?>"><?php echo  $found_lot['title']?></a></h3>
                                        <div class="lot__state">
                                            <div class="lot__rate">
                                                <span class="lot__amount">Стартовая цена</span>
                                                <span class="lot__cost"><?php echo  format_price($found_lot['start_price'])?></span>
                                            </div>
                                            <?php if (count_time($found_lot["expire_date"]) != "Торги окончены"): ?>
                                                <div class="lot__timer timer timer--finishing">
                                                    <!--Время-->
                                                    <?php echo count_time($found_lot["expire_date"]); ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="lot__timer timer timer--end">
                                                    <!--Время-->
                                                    <?php echo count_time($found_lot["expire_date"]); ?>
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


