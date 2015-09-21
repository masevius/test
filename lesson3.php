<?php

$date = array(mt_rand(1, time()),
    mt_rand(1, time()),
    mt_rand(1, time()),
    mt_rand(1, time()),
    mt_rand(1, time())
);

echo "Это массив юниксовыми метками <br> ";
echo var_dump($date);

$show_date = array(date('d.m.Y', $date[0]), //массив с переводом юниксовых меток в даты. Это для наглядности.
    date('d.m.Y', $date[1]),
    date('d.m.Y', $date[2]),
    date('d.m.Y', $date[3]),
    date('d.m.Y', $date[4]));

echo "Это тот же самый массив, но преобразованный, для наглядности, в даты юниксовыми метками <br> ";
echo var_dump($show_date);

$show_day = array(date('d', $date[0]), //массив $date с перечнем дней
    date('d', $date[1]),
    date('d', $date[2]),
    date('d', $date[3]),
    date('d', $date[4]));

$show_month = array(date('m', $date[0]), //массив $date с перечнем месяцев
    date('m', $date[1]),
    date('m', $date[2]),
    date('m', $date[3]),
    date('m', $date[4]));

echo '<br><br>Наименьший день это - ' . min($show_day) . "<br>";
echo '<br>Наибольший месяц это - ' . max($show_month) . "<br>";

echo '<br><br>Это сортировка по возрастанию <br>';
sort($date);
var_dump($date);

$selected = array_slice($date, -1, 1);
var_dump($selected);

echo date('d.m.Y h:i:s',$selected);

