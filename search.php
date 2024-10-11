<?php

include 'config.php';
session_start();

$id = $_SESSION['id'];

if(isset($_SESSION['admin_type'])){
    $user_type = $_SESSION['admin_type'];
}else{
    $user_type = $_SESSION['user_type'];
}


if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_type = $_POST['product_type'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' and user_id = '$id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, description, type, image, quantity) VALUE('$id', '$product_name', '$product_price', '$product_desc', '$product_type', '$product_image', '$product_quantity')") or die('query failed');

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <title>cart pan el</title>
</head>
<body>

<!-- header start -->

<header class="header">
    <div class="header-action__container">
        <a href="https://www.alenka.ru/my-order/" class="header-action__link">
            <p class="header-action__link">Только 8 и 9 октября! Положите в корзину товар всего за 1 рубль при покупке от 1500 руб.</p>
        </a>
    </div>

    <div class="hide-on-med-and-down">

        <div class="header__top">

            <div class="header__container">

                <div class="header__delivery" data-qa="header_delivery_desktop">
                    <p class="header__delivery-text">
                    <span class="header__top-delivery-city">Краснодар</span>
                     | 
                    <span class="header__top-delivery-time">
                     Доставка из Москвы
                    <br>
                    968 товаров | c 13.10.2022 | от 112 руб.   
                    </span>
                </p>
                </div>
                
                <div class="header__franshiza">
                    <a class="header__top-my-order" href="https://www.alenka.ru/my-order/">Где мой заказ?</a>
                     | 
                    <a class="header__link" href="https://www.alenka.ru/franchising/">Франшиза</a>
                </div>

                <ul class="header__list" style>
                    <li class="header__item" style="width: auto;">
                        <a class="header__link" href="https://www.alenka.ru/companies/">Оптовым клиентам</a>
                    </li>
                    <li class="header__item" style="width: auto;">
                        <a class="header__link" href="https://www.alenka.ru/delivery/">Доставка и оплата</a>
                    </li>
                    <li class="header__item" style="width: auto;">
                        <a class="header__link" href="https://www.alenka.ru/qr/">Проверить QR-код</a>
                    </li>
                    <li class="header__item" style="width: auto;">
                        <a class="header__link" href="https://www.alenka.ru/loyalty/">Карта «Аленка»</a>
                    </li>
                    <li class="header__item" style="width: auto;">
                        <a class="header__link" href="https://www.alenka.ru/about/jobs/">Вакансии</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="header__bottom">

            <div class="header__container">

                <div class="header__logo">
                  <a class="header__logo-link" href="main.php">
                    <img class="header__medium-logo-img" src="/img/logo.png" alt="Логотип Аленка">
                  </a>
                  <button class="header__catalog-btn" id="js-openDesktopCatalog" type="button" data-qa="header_catalog_button">
                    каталог
                  </button>  
                </div>

                <div class="header__call">
                  <a class="header__link header__call-number" href="tel:88004441496"> 8 800 444 1496 </a>
                  <p class="header__callback popup-callback-trigger" data-qa="header_callback_trigger-text">Обратный звонок</p>
                </div>

                <div class="icon">

                    <?php
                        if($user_type == 'admin')
                            echo '<a href="admin_products.php" class="fas fa-upload icons"></a>';
                    ?>
                    <a href="search.php" class="fas fa-search icons"></a>
                    <div id="user-btn" class="fas fa-user icons"></div>
                    <?php
                        $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$id'") or die('query failed');
                        $cart_rows_number = mysqli_num_rows($select_cart_number);
                    ?>
                    <a href="cart.php" class="fas fa-shopping-cart icons"> (<span><?php echo $cart_rows_number?></span>)</a>
                                        
                </div>

                <div class="account-box">

                    <p>Пользователь : <span><?php echo $_SESSION['name'];?></span></p>
                    <p>Почта : <span><?php echo $_SESSION['email'];?></span></p>
                    <a href="profile.php" class="account delete-btn">Профиль</a>
                    <a href="logout.php" class="account delete-btn">Выйти</a>

                </div>

            </div>

        </div>

        <nav class="header-bottom header-bottom-menu">
            <div class="container">
                <ul class="header-bottom-list">
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/novogodnie_podarki/">Новогодние подарки</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/novogodnie_podarki/">Свежая поставка</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/tolko_v_alenke/">Только в Алёнке</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/tovary-po-aktsii/">Товары по акции</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/novinki/">Новинки</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/konfety/">Конфеты</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/shokolad/">Шоколад</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/chay_kofe/">Чай, кофе</a>
                    </li>
                    <li class="header-bottom-list-item">
                        <a href="https://www.alenka.ru/catalog/vkusno_i_polezno/">Вкусно и полезно</a>
                    </li>
                </ul>
            </div>
        </nav>

    </div>
</header>

<!-- header end -->



<!-- section search start -->

<section class="filter">

    <h1 class="filter-title">КАТАЛОГ</h1>

    <form action="" method="post" class="search-form">
        <input type="text" id="search" name="search" placeholder="Поиск продуктов..." class="box" value="<?php if(isset($_POST['submit'])){echo $_POST['search'];}?>">
        <div class="title-search">
            Фильтры
        </div>
        <span>Описание</span>
        <textarea name="filter_desc" id="textarea" cols="30" rows="5" placeholder="Введите текст" class="box"><?php if(isset($_POST['submit'])){echo $_POST['filter_desc'];}?></textarea>
        <span>Тип</span>
        <select name="filter_type" id="select" class="box">
            <option value="" <?php if(isset($_POST['submit']) AND $_POST['filter_type'] == ''){echo "selected";}?>>Выберите тип</option>
            <option value="Торт" <?php if(isset($_POST['submit']) AND $_POST['filter_type'] == 'Торт'){echo "selected";}?>>Торты</option>
            <option value="Десерт" <?php if(isset($_POST['submit']) AND $_POST['filter_type'] == 'Десерт'){echo "selected";}?>>Десерты</option>
        </select>
        <span>Цена</span>
        <div class="box wrapper">
            <div class="price-input">
                <div class="field">
                    <span>ОТ</span>
                    <input type="number" class="input-min" name="filter_price_start" id="input_one" value="<?php if(isset($_POST['submit'])){echo $_POST['filter_price_start'];}else{echo 0;}?>" min="0" max="10000">
                </div>
                <div class="separator">-</div>
                <div class="field">
                    <span>ДО</span>
                    <input type="number" class="input-max" name="filter_price_end" id="input_two" value="<?php if(isset($_POST['submit'])){echo $_POST['filter_price_end'];}else{echo 10000;}?>" min="0" max="10000">
                </div>
            </div>
            <div class="slider">
                <div class="progress"></div>
            </div>
            <div class="range-input">
                <input type="range" class="range-min" min="0" max="10000" id="range-one" value="<?php if(isset($_POST['submit'])){echo $_POST['filter_price_start'];}else{echo 0;}?>" step="50">
                <input type="range" class="range-max" min="0" max="10000" id="range-two" value="<?php if(isset($_POST['submit'])){echo $_POST['filter_price_end'];}else{echo 10000;}?>" step="50">
            </div>
        </div>
        <div class="search-btn">
            <input type="submit" value="Поиск" name="submit" class="btn">
            <input type="submit" name="reset" value="Сброс фильтров" onclick="clearInput()" class="option-btn-products"> 
        </div>
    </form>

    <div class="box-container">
    <?php
    if(isset($_POST['submit'])){
        $search_item = $_POST['search'];
        $add_name = (empty($search_item)) ? '' : " AND name LIKE '%{$search_item}%'";
        $search_desc = $_POST['filter_desc'];
        $add_desc = (empty($search_desc)) ? '' : " AND description LIKE '%{$search_desc}%'";
        $search_type = $_POST['filter_type'];
        $add_type = (empty($search_type)) ? '' : " AND type = '$search_type'";
        $search_price_start = $_POST['filter_price_start'];
        $search_price_end = $_POST['filter_price_end'];
        $str = "SELECT * FROM `products` WHERE price BETWEEN '$search_price_start' AND '$search_price_end'".$add_name.$add_type.$add_desc;
        $select_products = mysqli_query($conn, $str) or die('query failed');

        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>    
    <form action="" method="post" class="box">
        <img src="/uploaded_img/<?php echo $fetch_products['image'];?>" alt="">
        <div class="name"><?php echo $fetch_products['name'];?></div>
        <div class="type"><?php echo $fetch_products['type'];?></div>
        <div class="description"><?php echo $fetch_products['description'];?></div>
        <div class="price"><?php echo $fetch_products['price'];?> р/кг</div>
        <input type="number" min="1" name="product_quantity" value="1" class="qty">
        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
        <input type="hidden" name="product_type" value="<?php echo $fetch_products['type'];?>">
        <input type="hidden" name="product_desc" value="<?php echo $fetch_products['description'];?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
        <input type="submit" value="Добавить" name="add_to_cart" class="btn">
    </form>
    <?php
            }
        }else{
            echo '<p class="empty">Ничего не нашло!</p>';
        }
    }else{
        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die();

            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
        ?>
        <form action="" method="post" class="box">
            <img src="/uploaded_img/<?php echo $fetch_products['image'];?>" alt="">
            <div class="name"><?php echo $fetch_products['name'];?></div>
            <div class="type"><?php echo $fetch_products['type'];?></div>
            <div class="description"><?php echo $fetch_products['description'];?></div>
            <div class="price"><?php echo $fetch_products['price'];?> р/кг</div>
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
            <input type="hidden" name="product_type" value="<?php echo $fetch_products['type'];?>">
            <input type="hidden" name="product_desc" value="<?php echo $fetch_products['description'];?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
            <input type="submit" value="Добавить" name="add_to_cart" class="btn">
        </form>
        <?php
            }
        }else{
            echo '<p class="empty">no products added yet!</p>';
        }
    }
    
    
    ?>
    </div>



</section>

<!-- section search end -->



<!-- footer start -->

<footer class="footer">

    <div class="footer-desktop hide-on-med-and-down">

        <div class="footer-desktop__container">

            <div class="footer-desktop__logo">
                <a class="footer-desktop__logo-link" href="/">
                   <img class="footer-desktop__logo-img" src="/img/logo.png" alt="Логотип Аленка"> 
                </a>
            </div>

            <div class="footer-desktop__grid">

                <div class="footer-desktop__about">
                   <h3 class="footer-desktop__title">О компании</h3>
                    <ul class="footer-desktop__list">
                        <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/stati/">История</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/stati/">Новости</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/stati/">Статьи</a>
                        </li>
                    </ul>
                </div>

                <a class="footer-desktop__vacancy footer-desktop__title" href="/about/jobs/"> Вакансии </a>
                
                <div class="footer-desktop__social">
                    <h3 class="footer-desktop__title">Социальные сети</h3>
                    <ul class="footer-desktop__social-list">
                        <li class="footer-desktop__social-item">
                            <a class="footer-desktop__social-link" rel="nofollow" href="//vk.com/shopalenka">
                                <img class="footer-desktop__social-img" src="/img/vk.svg" alt="ВКонтакте">
                            </a>
                        </li>
                        <li class="footer-desktop__social-item">
                            <a class="footer-desktop__social-link" rel="nofollow" href="//www.youtube.com/channel/UCXFDNNs6CHydWSi4h-5EX8w">
                                <img class="footer-desktop__social-img" src="/img/yt.svg" alt="Ютуб">
                            </a>
                        </li>
                        <li class="footer-desktop__social-item">
                            <a class="footer-desktop__social-link" rel="nofollow" href="//www.ok.ru/shopalenka">
                                <img class="footer-desktop__social-img" src="/img/odnoklassniki.svg" alt="Одноклассники">
                            </a>
                        </li>
                        <li class="footer-desktop__social-item">
                            <a class="footer-desktop__social-link" rel="nofollow" href="//t.me/shopalenka">
                                <img class="footer-desktop__social-img" src="/img/telegram.svg" alt="Телеграм">
                            </a>
                        </li>
                        <li class="footer-desktop__social-item">
                            <a class="footer-desktop__social-link" rel="nofollow" href="//zen.yandex.ru/id/595b989a8146c14bcd82158c">
                                <img class="footer-desktop__social-img" src="/img/dzen_black.svg" alt="Яндекс Дзен">
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="footer-desktop__opt footer-desktop__title">
                    <a href="/companies/">Оптовым клиентам</a>
                </div>

                <div class="footer-desktop__arenda footer-desktop__title">
                    <a href="/about/lease/">Аренда</a>

                </div>

                <div class="footer-desktop__postavshikam footer-desktop__title">
                    <a href="/about/supplier/">Поставщикам</a>
                </div>

                <a class="footer-desktop__franshiza footer-desktop__title" href="/franchising/">Франшиза </a>
                
                <div class="footer-desktop__customers">
                    <h3 class="footer-desktop__title">Покупателям</h3>
                    <ul class="footer-desktop__list">
                       <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/delivery/">Доставка и оплата</a>
                       </li> 
                       <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/delivery/">Возврат товара</a>
                       </li> 
                       <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/delivery/">Помощь</a>
                       </li> 
                       <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/delivery/">Договор оферты</a>
                       </li> 
                       <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/delivery/">Политика конфиденциальности</a>
                       </li> 
                       <li class="footer-desktop__item">
                            <a class="footer-desktop__link" href="/delivery/">Программа лояльности</a>
                       </li> 
                    </ul>
                </div>

                <a class="footer-desktop__address footer-desktop__title" href="/shops/"> Адреса магазинов </a>
                
                <div class="footer-desktop__security">
                    <h3 class="footer-desktop__title">Безопасность покупок</h3>
                    <div class="footer-desktop__security-wrap">
                       <a class="footer-desktop__security-link" href="/delivery/#payment">
                            <img class="footer-desktop__security-img" src="/img/visa.png" alt="Visa">
                        </a> 
                       <a class="footer-desktop__security-link" href="/delivery/#payment">
                            <img class="footer-desktop__security-img" src="/img/mastercard.png" alt="Visa">
                        </a> 
                       <a class="footer-desktop__security-link" href="/delivery/#payment">
                            <img class="footer-desktop__security-img" src="/img/mir.png" alt="Visa">
                        </a> 
                    </div>
                </div>

                <div class="footer-desktop__products">
                    <h3 class="footer-desktop__title">Продукция</h3>
                    <ul class="footer-desktop__list">
                        <li class="footer-desktop__item">
                            <a href="/catalog/alenka/">Аленка</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/rot-front/">Рот Фронт</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/lyubimye-s-detstva/">Любимые с детства</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/sladkie-istorii/">Сладкие Истории</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/korovka/">Коровка</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/obozhayka/">Обожайка</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/krasnyy-oktyabr/">Красный Октябрь</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/felicita/">Felicita</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/vdohnovenie/">Вдохновение</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/bodrost/">Бодрость</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/russkiy-shokolad/">Русский Шоколад</a>
                        </li>
                        <li class="footer-desktop__item">
                            <a href="/catalog/babaevskiy/">Бабаевский</a>
                        </li>
                    </ul>


                </div>

                <div class="footer-desktop__contacts">
                    <h3 class="footer-desktop__title">Контакты</h3>
                    
                    <div class="footer-desktop__contacts">
                        <a class="footer-desktop__contacts-tel" href="tel:88004441496"> 8 800 444 1496 </a>
                        <a class="footer-desktop__callback popup-callback-trigger" href="javascript:;" data-qa="footer_desktop_callback-text"> Заказать обратный звонок </a>
                        <p class="footer-desktop__worktime">Ежедневно с 09.00 до 21.00</p>
                        <ul class="footer-desktop__list footer-desktop__contacts-list">
                           <li class="footer-desktop__item">
                                <a class="footer-desktop__subtitle" href="/about/requisites/">Реквизиты</a>
                           </li> 
                           <li class="footer-desktop__item">
                                <a class="footer-desktop__subtitle" href="javascript:AlenkaJS.Modal.AskQuestion.open();">Обратная связь</a>
                           </li> 
                        </ul>
                    </div>

                </div>

                <div class="footer-desktop__subscribe">
                    <h3 class="footer-desktop__title">Подписка на рассылку</h3>
                    <div class="footer-desktop__subscribe-input-wrap">
                        <form id="subscribe" data-qa="footer_subscribe_form">
                            <input class="footer-desktop__subscribe-input" id="email" type="email" name="SENDER_SUBSCRIBE_EMAIL" placeholder="Электронная почта" data-qa="footer_subscribe_input">
                            <button class="footer-desktop__subscribe-btn" data-qa="footer_subscribe_submit" type="submit">
                                >
                            </button>     
                        </form>
                    </div>
                    <p class="footer-desktop__subscribe-accept">
                        Подписываясь на рассылку, Вы соглашаетесь с условиями 
                        <a class="footer-desktop__link_underline" href="/upload/documents/terms_of_use.pdf"> политики конфиденциальности</a>
                        .
                    </p>



                </div>

            </div>
        </div>


    </div>
</footer>

<!-- footer end -->





<!-- aside start -->

<script>

function clearInput() {
    document.getElementById('search').value = ''
    document.getElementById('textarea').value = ''
    document.getElementById('select').value = ''
    document.getElementById('range_one').valueAsNumber = 0
    document.getElementById('range_two').valueAsNumber = 10000
    document.getElementById('input_one').valueAsNumber = 0
    document.getElementById('input_two').valueAsNumber = 10000
}

</script>



<script src="/js/javascipt.js"></script>
<script src="/js/js.js"></script>

<!-- aside end -->

</body>
</html>