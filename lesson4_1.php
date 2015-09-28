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
var_dump($bd);

function display_atribs($nazvaniya_tovarov, $atrib) {
    global $bd;
    global $name;
    global $price;
    global $kol_zak;
    global $ost;
    global $discont;
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
}
?>
<html>
    <head>
    </head>
    <body>
        <table border="1px"  width="100%" height="20%">
            <tr bgcolor="#F0FFF0">
                <th width="25%" align="center">Перечень товаров</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Остаток</th>
                <th>Скидка</th>
                <th>Уведомления</th>
            </tr>

            <tr>
                <td width="25%"><?
                    display_atribs($nazvaniya_tovarov, $atrib);
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
                    ?></td>
                <td align="center"><?
                    echo $discont;
                    ?></td>
                <td align="center">

                </td>
        </table>
        <h1>Итого: <? 
        ?></h1> Вы заказали 
    </body>
</html>