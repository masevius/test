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
//    $podsumma = ;
    for ($i = 0; $i < count($nazvaniya_tovarov); $i++) {
        $skidka .= $bd[$nazvaniya_tovarov[$i]]['цена'] * $bd[$nazvaniya_tovarov[$i]]['diskont'] . "<br>";
        $podsumma .= $bd[$nazvaniya_tovarov[$i]]['количество заказано'] * $bd[$nazvaniya_tovarov[$i]]['цена'] . "<br>";
        $podsumma_so_skidkoy .= $bd[$nazvaniya_tovarov[$i]]['количество заказано'] * $bd[$nazvaniya_tovarov[$i]]['цена'] - $bd[$nazvaniya_tovarov[$i]]['цена'] * $bd[$nazvaniya_tovarov[$i]]['diskont'] . "<br>";
        $total_price += $podsumma_so_skidkoy;
    }
}

/*
  function vivod_skidki() {
  global $bd;
  foreach ($bd as $key => $value) {
  switch ($value['diskont']) {
  case 0.1:
  echo '10%<br>';
  case 0.2:
  echo '20%<br>';
  case 1:
  echo '0%<br>';
  break;
  default:
  break;
  }
  }
  } */
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