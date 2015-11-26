<?php
function test() {
    $arr = func_get_args();
    var_dump($arr);

    for ($j = (count($arr) - 1 ); $j >= 1; $j--) {
        for ($i = (count($arr) - 1 ); $i >= 1; $i--) {
            if ($arr[$i] < $arr[$i - 1]) {
                $temp = $arr[$i - 1];
                $arr[$i - 1] = $arr[$i];
                $arr[$i] = $temp;
            }
        }
    }
    var_dump($arr);
}

test(1, 556, 6, 5677, 22, 66, 89, 11, 3,324342315,66,6764,24,4);
?>