<?php
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
$atrib = array_keys($bd['игрушка мягкая мишка белый']); //массив с атрибутами товаров
//var_dump($bd);
foreach ($bd as $key => &$value) {
    if ($value['diskont'] == 'diskont1') {
        $value['diskont'] = "10%";
    } elseif ($value['diskont'] == 'diskont2') {
        $value['diskont'] = "20%";
    } else {
        $value['diskont'] = "0%";
    }var_dump($value);
}var_dump($bd);

if ($bd['игрушка детская велосипед']['количество заказано'] > 3) {
    $bd['игрушка детская велосипед']['diskont'] = "30%";
}

function display_atribs($nazvaniya_tovarov) {
    global $bd;
    global $name;
    global $price;
    global $kol_zak;
    global $ost;
    global $discont;
    global $kol_zakaz_naim;
    global $podsumma;
    global $total_price;
    global $kol_zakaz_naim;
    global $podsumma_so_skidkoy;
    global $skidka;
    global $prevish;

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
        echo $bd[$nazvaniya_tovarov[$i]]['diskont'] . "<br>";
    }

    $kol_zakaz_naim = 0;
    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {
        if ($bd[$nazvaniya_tovarov[$i]]['количество заказано'] > 0) {
            ++$kol_zakaz_naim;
        }
    }
    $total_price = 0;
    static $x;
    /* foreach ($bd as $key => $value) {
      if ($value['diskont'] == "10%") {
      $x = $value['цена'] * 0.9;
      $podsumma_so_skidkoy .= $x . "<br>";
      } if ($value['diskont'] == "20%") {
      $x = $value['цена'] * 0.8;
      $podsumma_so_skidkoy .= $x . "<br>";
      }
      if ($value['diskont'] == "30%") {
      $x = $value['цена'] * 0.7;
      $podsumma_so_skidkoy .= $x . "<br>";
      } if ($value['diskont'] == "0%") {
      //            $x = $value['цена'] * 1;
      $podsumma_so_skidkoy .= ($value['цена'] * $value['количество заказано']) . " (Нет скидки) <br>";
      }
      } */

    foreach ($bd as $key => $value) {

        if ($value['осталось на складе'] >= $value['количество заказано']) {
            $x = $value['цена'] * $value['количество заказано'];
            $podsumma .= $x . "<br>";
            if ($value['diskont'] == "10%") {
                $podsumma_so_skidkoy .= ($x * 0.9) . "<br>";
            } if ($value['diskont'] == "20%") {

                $podsumma_so_skidkoy .= $x * 0.8 . "<br>";
            }
            if ($value['diskont'] == "30%") {
                $podsumma_so_skidkoy .= ($x * 0.7) . "<br>";
            } if ($value['diskont'] == "0%") {
                $podsumma_so_skidkoy .= $x . " (Нет скидки) <br>";
            } 
        } else {
            $x = $value['осталось на складе'] * $value['цена'];
            $podsumma .= $x . "<br>";
            if ($value['diskont'] == "10%") {
                $podsumma_so_skidkoy .= ($x * 0.9) . "<br>";
            } if ($value['diskont'] == "20%") {
//                $x = $x * 0.8;
                $podsumma_so_skidkoy .= ($x * 0.8) . "<br>";
            }
            if ($value['diskont'] == "30%") {
                $podsumma_so_skidkoy .= ($x * 0.7). "<br>";
            } if ($value['diskont'] == "0%") {
                $podsumma_so_skidkoy .= $x . " (Нет скидки) <br>";
            }
        }$total_price += $x;
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
                    <? ?>
                </td>
        </table>
        <?
        echo "<h1>Итого: </h1>";

        echo 'Общая сумма заказнанных товаров -  ' . $total_price . " <br> Всего наименований - " . $kol_zakaz_naim;
        ?>
    </body>
</html>