<?php

echo "ceil:".ceil(4).'<br>';
echo "floor:".  floor(6.345).'<br>';
echo "round:". round(6.236,2).'<br>';

mt_srand(time());
echo mt_rand(10,100);



?>
