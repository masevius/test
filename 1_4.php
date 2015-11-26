
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

    $chapter .= '<tr align="center" >';
    $chapter .= '<td bgcolor="#FFEFD5" width="20px"> 1</td>';
    for ($x = 1; $x < $col; $x++) {
        $chapter .= '<td bgcolor="#F0FFFF">' . ($x + 1) . '</td>';
    }
    $chapter .= '</tr>';
//    echo $chapter;

    if (func_num_args() <> 2 and check(func_get_args()) == FALSE) {
        echo 'Нужно ввести 2, причем целых числа.<br> Вы не выполнили одно, а может и сразу два условия!';
    } else {

        $show .= '<table border=\"1px\">';
        $show .= $chapter;
        $fist_mn = 2;

        for ($i = 0; $i < ($row - 1); $i++) {
            $second_mn = 2;
            $show .= '<tr align="center"><td bgcolor="#FFEFD5">' . $fist_mn . '</td>';
            for ($y = 0; $y < ($col - 1); $y++) {
                $show .= '<td width="20px">' . ($fist_mn * $second_mn++) . '</td>';
            }$show .='</tr>';
            $fist_mn++;
        }
        $show .='</table>';


//        for ($i = 0; $i < $row; $i++) {
//            $show .= '<tr>';
//            for ($y = 0; $y < $col; $y++) {
//                $show .= '<td>' . ($y + 1) . '</td>';
//            }$show .= '</tr>';
//        }
    }echo $show;
}

@tabl(5,10);
?>