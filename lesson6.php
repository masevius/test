<style>
    select {
        width: 200px; /* Ширина списка в пикселах */
    }    
</style>
<?php
session_start();

$city = array('641780' => 'Москва', '641490' => 'Подольск', '641510' => 'Санкт-Петербург');
$metro = array('2028' => 'Берёзовая роща', '2018' => 'Гагаринская', '2029' => 'Золотая Нива');
$realty = array('25' => 'Дома, дачи, коттеджи', '26' => 'Земельные участки', '42' => 'Коммерческая недвижимость');
$avto = array('9' => 'Автомобили с пробегом', '109' => 'Новые автомобили', '14' => 'Мотоциклы и мототехника');
$list = array('Недвижимость' => $realty, 'Транспорт' => $avto);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
    $_SESSION[uniqid()] = $_POST;
} elseif (isset($_GET['edit'])) {
    unset($_SESSION[$_GET['edit']]);
}

function checked($param, $num) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION[$_GET['id']][$param]) && $_SESSION[$_GET['id']][$param] == $num) {
        echo 'checked';
    }
}

function showad() {
    foreach ($_SESSION as $atrib => $value) {//
        echo '| <a href="http://xaver.loc/lesson6.php?id=' . $atrib . '">' . $value['title'] . '</a>' . '|' . $value['price'] . ' рублей |' . $value['seller_name'] .
        '| <a href="http:./lesson6.php?edit=' . $atrib . '">Удалить</a><br>';
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
                } else {
                    echo sprintf('<option value="%d">%s</option>', $key_ad, $categ);
                }
            }
        }
    }
}

function returnID($param) {
    global $select;

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION[$_GET['id']][$param])) {
        echo $_SESSION[$_GET['id']][$param];
}
?>
<form  method="POST" id="data">
    <table>       
        <tr> <label><input checked <?php checked('private', '1'); ?> type="radio" name="private" value="1" >Частное лицо </label>
        <label><input  <?php checked('private', '0'); ?> type="radio" name="private" value="0">Компания </label>
        </tr>
        <tr>
            <td>Ваше имя<br><br>Электронная почта
            </td>
            <td><input size="25%" type="text"  value="<?php returnID('seller_name') ?>" name="seller_name" >
                <br><br> <input size="25%" type="text" value="<?php returnID('email') ?>" name="email">
            </td>
        <tr>  <td colspan="2"><input <?php checked('otkaz', '1'); ?> type="checkbox" name="otkaz" value="1">Я не хочу получать вопросы по объявлению на e-mail</td>
        </tr>

        </tr>
        <tr>
            <td>Номер телефона<br><br>Город<br><br>Метро<br>
            </td>
            <td><input size="25%" type="text" class="form-input-text" value="<?php returnID('phone') ?>" name="phone" id="fld_phone">

                <br><br> <select title="Выберите Ваш город" name="location_id"> 
                    <option value="">-- Выберите город --</option>
                    <option  disabled="disabled">-- Города --</option>
                    <?php selected('city'); ?>   
                </select>
                <br><br> <select title="Выберите станцию метро" name="metro_id" > 
                    <option value="">-- Выберите станцию метро --</option>
                    <?php selected('metro'); ?></select>
            </td>
        </tr>  
        <tr>
            <td><br>Категория<br><br>Название объявления</td>
            <td><br><select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                    <option value="">-- Выберите категорию --</option>
                    <?php selected('category'); ?>
                </select>
                <br><br><input size="57" type="text" maxlength="50" class="form-input-text-long" value="<?PHP returnID('title') ?>" name="title" id="fld_title">
            </td>
        </tr>
        <tr><td><br>Описание объявления<br><br><br>Цена
            </td>
            <td ><br><textarea cols="50" maxlength="3000"  name="description"><?PHP returnID('description') ?></textarea>

                <br><br> <input size="10" type="text" maxlength="9" class="form-input-text-short" value="<?PHP returnID('price') ?>" name="price" id="fld_price"> .руб
            </td>
        </tr>
<tr><td colspan="2" align="center"><br><div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
        <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span> <input type="submit" value="Отправить" id="form_submit" name="main_form_submit" class="vas-submit-input"> </div>
    </div></td></tr>

    </table>





    
</form>
<?php
showad();
if (empty($_SESSION)) {
    echo "<br><h2>Объявления отсутствуют</h2>";
}
//var_dump($_SESSION);
?>

