<?php

function test($a, $b) {
    if ($a > $b)
        exit;

    if (is_int($a / 2)) {
        echo $a . '<br>';
        ++$a;
    } else {
        ++$a;
    }
    test($a, $b);
}

test(1, 100);

//?>