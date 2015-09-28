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
/* print_r($nazvaniya_tovarov);
  print_r($atrib);
 */
//print_r($atrib);
for ($i = 0;
$i < count($nazvaniya_tovarov); $i++){
print_r($nazvaniya_tovarov[$i]);
echo '///////';
for ($y = 0; $y < count($atrib); $y++) {
    echo " ";
    print_r($bd[$nazvaniya_tovarov[$i]][$atrib[$y]]);
    echo "   ";
    }
    echo '<br>';
}

?>
