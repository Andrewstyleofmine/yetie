
    <section class="lots">


            <div class="lots__header">
                <h2>История лотов</h2>
            </div>
            <ul class="lots__list">
                <?php foreach ($history as $lot): ?>
                    <li class="lots__item lot">
                        <div class="lot__image">
                            <img src="<?php echo $lot['image_url']?>" width="350" height="260" alt="">
                        </div>
                        <div class="lot__info">
                            <span class="lot__category"><?php echo $lot['category']?></span>
                            <h3 class="lot__title"><a class="text-link" href="../lot/<?php echo $lot['id']?>"><?php echo  $lot['title']?></a></h3>
                            <div class="lot__state">
                                <div class="lot__rate">
                                    <span class="lot__amount">Стартовая цена</span>
                                    <span class="lot__cost"><?php echo format_price($lot['start_price'])?></span>
                                </div>
                                <?php if (count_time($lot["expire_date"]) != "Торги окончены"): ?>
                                    <div class="lot__timer timer timer--finishing">
                                        <!--Время-->
                                        <?php echo count_time($lot["expire_date"]); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="lot__timer timer timer--end">
                                        <!--Время-->
                                        <?php echo count_time($lot["expire_date"]); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

    </section>

