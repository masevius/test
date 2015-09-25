<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

echo '<h2>Задание 4 - мое первое подобие интернет-магазина</h2>';
echo '<h2><br><br>Корзина</h2>';
echo '<hr>';
//создание массивов с ценами и т.д
$bear = array('price' => mt_rand(1, 10),
    'kol_zak' => mt_rand(1, 10),
    'ost' => mt_rand(1, 10),
    'discont' => mt_rand(0, 2));
$jacket = array('price' => mt_rand(1, 10), 
    'kol_zak' => mt_rand(1, 10),
    'ost' => mt_rand(1, 10),
    'discont' => mt_rand(0, 2));
$bike = array('price' => mt_rand(1, 10),
    'kol_zak' => mt_rand(1, 10),
    'ost' => mt_rand(1, 10), 
    'discont' => mt_rand(0, 2));
// расчет итоговой цены по группам товаров
$total_pice_bear = $bear['price'] * $bear['kol_zak'];
$total_pice_jacket = $jacket['price'] * $jacket['kol_zak'];

if ($bike['kol_zak'] >= 3) {
    $total_pice_bike = ($bike['price'] * 0.7 * $bike['kol_zak']);
    $bike['discont'] = 0;
}

function netnasklade($x, $y) { //$x - это переданное количество заказов; $y - сколько осталось на складе
    if ($x > $y) {
        echo "К сожалению у нас нет $x  штук, осталось только  $y";
    }
}

netnasklade($bear['kol_zak'], $bear['ost']);

function skidki($x, $y) {
    global $posle_skidki;
    switch ($y) {
        case '1':
            $posle_skidki = $x - $x * 0.1;
            break;
        case '2':
            $posle_skidki = $x - $x * 0.2;
            break;
    }
}

skidki($total_pice_bike, $bike['discont']);
echo $posle_skidki;


echo 'Наименование              | Цена за штуку     |  Количество заказано     |Осталось на складе     |Discont     |Сумма     |<br>';
echo "игрушка мягкая мишка белый".$bear['price']."       ".$bear['kol_zak']."            ".$bear['ost']."      ".$bear['discont']."      ".$total_pice_bear." ";

//echo $nazv_price, $bear['price'] . '<br>';
//echo $nazv_kolzak, $bear['kol_zak'] . '<br>';
//echo $nazv_ost, $bear['ost'] . '<br>';
//echo $nazv_diskont, $bear['discont'] . '<br>';


echo '        При покупке 3 и более велосипедов Вам предоставляется сидка 30%';
//$bd = parse_ini_string($ini_string, true);
//print_r($bd);