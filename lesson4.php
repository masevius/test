<?php
function Test_s(){
    static $a=1;
    $a=$a*2;
    echo $a."<br>";
}

Test_s();
echo $a."<br>";
Test_s();
