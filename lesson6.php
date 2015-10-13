
<?php
session_start();
//$_SESSION['ads'][rand(1, time())] = $_POST;
//define('site', 'http://xaver.loc')
$city = array('641780' => 'Москва', '641490' => 'Подольск', '641510' => 'Санкт-Петербург');
$metro = array('2028' => 'Берёзовая роща', '2018' => 'Гагаринская', '2029' => 'Золотая Нива');
$realty = array('25' => 'Дома, дачи, коттеджи', '26' => 'Земельные участки', '42' => 'Коммерческая недвижимость');
$avto = array('9' => 'Автомобили с пробегом', '109' => 'Новые автомобили', '14' => 'Мотоциклы и мототехника');
$list = array('Недвижимость' => $realty, 'Транспорт' => $avto);
var_dump($list);
var_dump($_GET);
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
    $_SESSION[uniqid()] = $_POST;
} elseif (isset($_GET['edit'])) {
    unset($_SESSION[$_GET['edit']]);
}

function showad() {
    foreach ($_SESSION as $atrib => $value) {//
        echo '| <a href="http://xaver.loc/lesson6.php?id=' . $atrib . '">' . $value['title'] . '</a>' . '|' . $value['price'] . '|' . $value['seller_name'] .
        '| <a href="http://xaver.loc/lesson6.php?edit=' . $atrib . '">Удалить</a><br>';
    }
}

function selected($param) {
    global $city, $metro, $list;
    if ($param == 'city') {
        foreach ($city as $key => $gorod) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && $key == $_SESSION[$_GET['id']]['location_id']) {
                echo sprintf('<option selected="" value="%d">%s</option>', $key, $gorod);
            } else {
                echo sprintf('<option value="%d">%s</option>', $key, $gorod);
            }
        }
    } elseif ($param == 'metro') {
        foreach ($metro as $key => $stantion) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && $key == $_SESSION[$_GET['id']]['metro_id']) {
                echo sprintf('<option selected="" value="%d">%s</option>', $key, $stantion);
            } else {
                echo sprintf('<option value="%d">%s</option>', $key, $stantion);
            }
        }
    } elseif ($param == 'category') {
//        $cut = '';

        foreach ($list as $main_categ => $value) {
            echo sprintf('<optgroup label="%s">', $main_categ);
            foreach ($value as $key_ad => $categ) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && $key_ad == $_SESSION[$_GET['id']]['category_id']) {
                    echo sprintf('<option selected=""  value="%d">%s</option>', $key_ad, $categ);
                   
                }else{
                    echo sprintf('<option value="%d">%s</option>', $key_ad, $categ);
                }
            }
        }

    }
}

//echo $ad;
//var_dump($_SESSION);
//var_dump($_GET);
//var_dump($_SERVER);
//session_unset();
    function returnID($param) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION[$_GET['id']][$param])) {
            echo $_SESSION[$_GET['id']][$param];
//        return $_SESSION[$_GET['id']][$param];
        }
//    else {
//        return "";
//    }
    }
    ?>
    <form  method="POST">
        <div class="form-row-indented"> <label class="form-label-radio"><input type="radio" checked="" value="1" name="private">Частное лицо</label> <label class="form-label-radio"><input type="radio" value="0" name="private">Компания</label> </div>
        <div class="form-row"> <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="form-input-text" value="<?php returnID('seller_name') ?>" name="seller_name" id="fld_seller_name">
        </div>

        <div class="form-row"> <label for="fld_email" class="form-label">Электронная почта</label>
            <input type="text" class="form-input-text" value="<?php returnID('email') ?>" name="email" id="fld_email">
        </div>
        <div class="form-row-indented"> <label class="form-label-checkbox" for="allow_mails">
                <input type="checkbox" value="<?php returnID('allow_mails') ?>" name="allow_mails" id="allow_mails" class="form-input-checkbox">
                <span class="form-text-checkbox">Я не хочу получать вопросы по объявлению по e-mail</span> </label> </div>
        <div class="form-row"> <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label>
            <input type="text" class="form-input-text" value="<?php returnID('phone') ?>" name="phone" id="fld_phone">
        </div>
        <div id="f_location_id" class="form-row form-row-required">
            <label for="region" class="form-label">Город</label> 
            <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select"> 
                <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>
                <?php selected('city'); ?>        
            </select> <div id="f_metro_id"> 
                <select title="Выберите станцию метро" name="metro_id" id="fld_metro_id" class="form-input-select"> 
                    <option value="">-- Выберите станцию метро --</option>
                    <?php selected('metro'); ?>

                </select> </div> <div id="f_district_id"> 



                <div class="form-row"> <label for="fld_category_id" class="form-label">Категория</label> 
                    <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                        <option value="">-- Выберите категорию --</option>

                        <?php  selected('category');  ?>

                        <div style="display: none;" id="params" class="form-row form-row-required"> <label class="form-label ">
                                Выберите параметры
                            </label> <div class="form-params params" id="filters">
                            </div> </div>
                        <div id="f_map" class="form-row form-row-required hidden"> <label class="form-label c-2">Укажите местоположение объекта на&nbsp;карте</label> <div class="b-address-map j-address-map disabled"> <div class="wrapper"> <div class="map" id="address-map"></div> <div class="overlay"> <div class="modal">Сначала <span class="fill-in pseudo-link">укажите адрес</span></div> </div> </div> <div class="result c-2 hidden"> <div class="map-success">
                                        Маркер указывает на: <span class="address-line"></span>.
                                        <span class="confirm pseudo-link hidden">Это верный адрес</span> </div> <div class="map-error">Мы не смогли автоматически определить адрес.</div> </div> <input type="hidden" disabled="disabled" value="" class="j-address-latitude" name="coords[lat]"> <input type="hidden" disabled="disabled" value="" class="j-address-longitude" name="coords[lng]"> <input type="hidden" disabled="disabled" value="" class="j-address-zoom" name="coords[zoom]"> </div> </div>
                        <div id="f_title" class="form-row f_title"> <label for="fld_title" class="form-label">Название объявления</label> <input type="text" maxlength="50" class="form-input-text-long" value="" name="title" id="fld_title"> </div>
                        <div class="form-row"> <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"></textarea> </div>
                        <div id="price_rw" class="form-row rl"> <label id="price_lbl" for="fld_price" class="form-label">Цена</label> <input type="text" maxlength="9" class="form-input-text-short" value="0" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span> <a class="link_plain grey right_price c-2 icon-link" id="js-price-link" href="/info/pravilnye_ceny?plain"><span>Правильно указывайте цену</span></a> </div>

                        <div id="f_images" class="form-row"> <label for="fld_images" class="form-label"><span id="js-photo-label">Фотографии</span><span class="js-photo-count" style="display: none;"></span></label> <input type="file" value="image" id="fld_images" name="image" accept="image/*" class="form-input-file"> <span style="line-height:22px;color: gray; display: none;" id="fld_images_toomuch">Вы добавили максимально возможное количество фотографий</span> <span style="display: none;" id="fld_images_overhead"></span> </div> <div style="display: none; margin-top: 0px;" class="form-row-indented images" id="files">
                            <div style="display: none;" id="progress"> <table><tbody><tr><td> <div><div></div></div> </td></tr></tbody></table> </div> </div>

                        <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
                            <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span> <input type="submit" value="Далее" id="form_submit" name="main_form_submit" class="vas-submit-input"> </div>
                        </div>
                        </form>
                        <?php
                        showad();
                        var_dump($_SESSION);
//var_dump($_POST);
//session_unset();
//var_dump($_SERVER);
                        ?>

