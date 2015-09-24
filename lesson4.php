<?php

echo '<h2>Задание 4 -мое первое подобие интернет-магазина</h2>';

$bear = array('price' => mt_rand(1, 10), 'kol_zak' => mt_rand(1, 10), 'ost' => mt_rand(1, 10), 'discont' => mt_rand(0, 2));
$jacket = array('price' => mt_rand(1, 10), 'kol_zak' => mt_rand(1, 10), 'ost' => mt_rand(1, 10), 'discont' => mt_rand(0, 2));
$bike = array('price' => mt_rand(1, 10), 'kol_zak' => mt_rand(1, 10), 'ost' => mt_rand(1, 10), 'discont' => mt_rand(0, 2));

$nazv_price = 'Цена = ';
$nazv_kolzak = 'Количество заказано = ';
$nazv_ost = 'Осталось на складе = ';
$nazv_diskont = 'Discont = ';

echo $nazv_price, $bear['price'] . '<br>';
echo $nazv_kolzak, $bear['kol_zak'] . '<br>';
echo $nazv_ost, $bear['ost'] . '<br>';
echo $nazv_diskont, $bear['discont'] . '<br>';

