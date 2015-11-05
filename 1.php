<?php

function check($par) {
//    print_r($par);
    for ($i = 0; $i < count($par); $i++) {
        if (!is_int($par[$i])) {
            return FALSE;
        }
    }
}

function tabl() {

    $row = (func_get_arg(0) > func_get_arg(1)) ? func_get_arg(1) : func_get_arg(0);
    $col = (func_get_arg(0) > func_get_arg(1)) ? func_get_arg(0) : func_get_arg(1);

    $show = '';
    $chapter = '';

    $chapter = '<tr>';
    for ($x = 0; $x < $col; $x++) {
        $chapter .= '<td>' . $x . '<td>';
    }
    $chapter = '</tr>';
    echo $chapter;

    if (func_num_args() <> 2 and check(func_get_args()) == FALSE) {
        echo 'Нужно ввести 2, причем целых числа.<br> Вы не выполнили одно, а может и сразу два условия!';
    } else {
        $show .= '<table border="1px">';
        $show .= $chapter;
        for ($i = 0; $i < $row; $i++) {
            $show .= '<tr>';
            for ($y = 0; $y < $col; $y++) {
                $show .= '<td>' . ($y + 1) . '</td>';
            }$show .= '</tr>';
        }
    }echo $show;
}

tabl(16, 4);
?>