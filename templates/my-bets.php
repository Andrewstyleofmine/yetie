
        <section class="rates container">
            <h2>Мои ставки</h2>
            <table class="rates__list">
                <?php foreach ($user_bets as $user_bet): ?>
                    <?php if (count_time($user_bet['expire_date']) != "Торги окончены"): ?>

                        <tr class="rates__item">
                                <td class="rates__info">
                                    <div class="rates__img">
                                        <img src="<?php echo $user_bet['image_url']?>" width="54" height="40" alt="Сноуборд">
                                    </div>
                                    <h3 class="rates__title"><a href="../lot/<?php echo $user_bet['lot_id']?>"><?php echo $user_bet['title']?></a></h3>
                                </td>
                                <td class="rates__category">
                                    <?php echo $user_bet['category']?>
                                </td>

                                    <td class="rates__timer">
                                        <div class="timer timer--finishing"><?php echo count_time($user_bet['expire_date']); ?></div>
                                    </td>
                                <td class="rates__price">
                                    <?php echo number_format($user_bet['bet_price'],0,'.', ' ').' р'?>
                                </td>
                                <td class="rates__time">
                                    <?php echo $user_bet['bet_date']; ?>
                                </td>
                        </tr>
                    <?php elseif ($user_bet['winner_id'] != NULL): ?>
                        <tr class="rates__item rates__item--win">
                            <td class="rates__info">
                                <div class="rates__img">
                                    <img src="../img/rate3.jpg" width="54" height="40" alt="Крепления">
                                </div>
                                <div>
                                    <h3 class="rates__title"><a href="../lot/<?php echo $user_bet['lot_id']?>"><?php echo $user_bet['title']?></a></h3>
                                    <p><?php echo $get_contacts_arr[$user_bet['lot_id']] ?></p>
                                </div>
                            </td>
                            <td class="rates__category">
                                <?php echo $user_bet['category']?>
                            </td>
                            <td class="rates__timer">
                                <div class="timer timer--win">Ставка выиграла</div>
                            </td>
                            <td class="rates__price">
                                <?php echo number_format($user_bet['bet_price'],0,'.', ' ').' р'?>
                            </td>
                            <td class="rates__time">
                                <?php echo $user_bet['bet_date']; ?>
                            </td>
                        </tr>
                        <?php elseif (count_time($user_bet['expire_date']) == "Торги окончены"): ?>
                        <tr class="rates__item rates__item--end">
                            <td class="rates__info">
                                <div class="rates__img">
                                    <img src="<?php echo $user_bet['image_url']?>" width="54" height="40" alt="Сноуборд">
                                </div>
                                <h3 class="rates__title"><a href="../lot/<?php echo $user_bet['lot_id']?>"><?php echo $user_bet['title']?></a></h3>
                            </td>
                            <td class="rates__category">
                                <?php echo $user_bet['category']?>
                            </td>

                            <td class="rates__timer">
                                <div class="timer timer--end"><?php echo count_time($user_bet['expire_date']); ?></div>
                            </td>
                            <td class="rates__price">
                                <?php echo number_format($user_bet['bet_price'],0,'.', ' ').' р'?>
                            </td>
                            <td class="rates__time">
                                <?php echo $user_bet['bet_date']; ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>

            </table>
        </section>


