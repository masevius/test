<?php
/* Задание выполнено коряво, но все операции производит корректно.
 * Позже оптимизирую код.
 * Алгоритм работы такой - в блоке <table> в разделе <html>
 * вызывается display_atribs(), которой передается в качестве
 * параметра - массив с атрибутами и названием товара.
 * Функция производит вычисления и присваивает каждой глобальной переменной
 * значенияодной из столбцов таблицы в текстовом виде. Эти значения потом
 * и выводятся в секции <table>, с помощью конструкции echo $название переменной.
  */
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

$ini_string = '
[игрушка мягкая мишка белый]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';
    
[одежда детская куртка синяя синтепон]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';
    
[игрушка детская велосипед]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';

';

$bd = parse_ini_string($ini_string, TRUE);

$nazvaniya_tovarov = array_keys($bd); //массив с названиями товаров
var_dump($bd);
foreach ($bd as $key => &$value) { //заменяет значения в массиве с diskont на скидка%
    if ($value['diskont'] == 'diskont1') {
        $value['diskont'] = "10%";
    } elseif ($value['diskont'] == 'diskont2') {
        $value['diskont'] = "20%";
    } else {
        $value['diskont'] = "0%";
    }
}

if ($bd['игрушка детская велосипед']['количество заказано'] > 3) {//если велосипедов заказано > 3шт. в массиве присваивается 30%
    $bd['игрушка детская велосипед']['diskont'] = "30%";
}

function display_atribs($nazvaniya_tovarov) {
    global $bd;
    global $name;//названия товаров в столбец
    global $price;//цены в столбец
    global $kol_zak;//заказано в столбец
    global $ost;//осталось на складе в столбец
    global $discont;//скидка в столбец
    global $kol_zakaz_naim;//сколько наименований заказано
    global $podsumma;//стоимость товаров в столбец
    global $total_price;//конечная стоимость
    global $podsumma_so_skidkoy;//цена со скидкой в столбец
    global $alert;//уведомления в столбец
    global $total_kol;//Общее количество заказанных товаров с учетом наличия на складе в столбец

    $name = " ";
    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {
        $name .= ($i + 1) . ') ' . $nazvaniya_tovarov[$i] . "<br>";
    }
    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {
        $price .= $bd[$nazvaniya_tovarov[$i]]['цена'] . "<br>";
    }
    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {
        $kol_zak .= $bd[$nazvaniya_tovarov[$i]]['количество заказано'] . "<br>";
    }
    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {
        $ost .= $bd[$nazvaniya_tovarov[$i]]['осталось на складе'] . "<br>";
    }

    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {

        $discont .= $bd[$nazvaniya_tovarov[$i]]['diskont'] . "<br>";
    }

    $kol_zakaz_naim = 0;
    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {
        if ($bd[$nazvaniya_tovarov[$i]]['количество заказано'] > 0) {
            ++$kol_zakaz_naim;
        }
    }

    $total_price = 0;
    static $x;
    foreach ($bd as $key => $value) {

        if ($value['осталось на складе'] >= $value['количество заказано']) {
            $x = $value['цена'] * $value['количество заказано'];
            $podsumma .= $x . "<br>";
            if ($value['diskont'] == "10%") {
                $x1 = $x * 0.9;
                $podsumma_so_skidkoy .= $x1 . "<br>";
            } if ($value['diskont'] == "20%") {
                $x1 = $x * 0.8;
                $podsumma_so_skidkoy .= $x1 . "<br>";
            }
            if ($value['diskont'] == "30%") {
                $x1 = $x * 0.7;
                $podsumma_so_skidkoy .= $x1 . "<br>";
            } if ($value['diskont'] == "0%") {
                $x1 = $x * 1;
                $podsumma_so_skidkoy .= $x . " (Нет скидки) <br>";
            }$total_price += $x1;
        } else {
            $x = $value['осталось на складе'] * $value['цена'];
            $podsumma .= $x . "<br>";
            if ($value['diskont'] == "10%") {
                $x1 = $x * 0.9;
                $podsumma_so_skidkoy .= $x1 . "<br>";
            } if ($value['diskont'] == "20%") {

                $x1 = $x * 0.8;
                $podsumma_so_skidkoy .= $x1 . "<br>";
            }
            if ($value['diskont'] == "30%") {
                $x1 = $x * 0.7;
                $podsumma_so_skidkoy .= $x1 . "<br>";
            } if ($value['diskont'] == "0%") {
                $x1 = $x * 1;
                $podsumma_so_skidkoy .= $x . " (Нет скидки) <br>";
            }$total_price += $x1;
        }
    }
    $alert = " ";
    foreach ($bd as $key => $value) {
        if ($value['осталось на складе'] == 0) {
            $alert.= "Отсутствует на складе<br>";
        } if ($value['осталось на складе'] > 0 and $key !== 'игрушка детская велосипед') {
            $alert.= "<br>";
        }
        if ($key == 'игрушка детская велосипед' and $value['количество заказано'] >= 3
                and $value['осталось на складе'] > 0) {
            $alert.= "Вам предоставлена скидка 30%<br>";
        }
    }
    foreach ($bd as $key => $value) {
        if ($value['количество заказано'] > $value['осталось на складе']) {
            $total_kol += $value['осталось на складе'];
        } else {
            $total_kol += $value['количество заказано'];
        }
    }
}
?>


<html>
    <head>
    </head>
    <body><? display_atribs($nazvaniya_tovarov);
        ?>
        <table border="1px"  width="100%" height="10%">
            <tr bgcolor="#F0FFF0">
                <th>Перечень товаров</th>;
                <th>Цена</th>
                <th>Кол-во заказано</th>
                <th width="20%" >Остаток</th>
                <th>Скидка</th>
                <th>Стоимость</th>
                <th width="20%">Цена со скидкой</th>
                <th width="20%">Уведомления</th>
            </tr>

            <tr>
                <td><?
                    echo $name;
                    ?></td>
                <td align="center"><?
                    echo $price;
                    ?></td>
                <td align="center"><?
                    echo $kol_zak;
                    ?></td>
                <td align="center"><?
                    echo $ost;
                    ?>
                </td>
                <td align="center"><?
                    echo $discont;
                    ?>
                </td>
                <td align="center">

                    <? echo $podsumma; ?>

                </td>
                <td align="center">
                    <?
                    echo $podsumma_so_skidkoy;
                    ?>
                </td>
                <td align="center">
                    <? 
                    echo $alert;
                    ?>
                </td>
        </table>
        <?
        echo "<h1>Итого: </h1>";

        echo 'Общая сумма заказнанных товаров :  ' . $total_price . " <br> Всего наименований : " . $kol_zakaz_naim;
        echo '<br> Общее количество заказанных товаров с учетом наличия на складе: '.$total_kol;
        ?>
    </body>
</html>