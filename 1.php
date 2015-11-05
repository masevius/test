<form method="POST">
    Введите число<br><input type=text" name="inner" > 
    <select name="oper">
        <option value="+">+</option>>
        <option value="-">-</option>>
    </select>
    <br><br><input type="submit" value="Отправить">
</form>
<?php
session_start();
$_SESSION['oper'] = $_POST['oper'];
$_SESSION[uniqid()] = $_POST['inner'];
var_dump($_SESSION);
//session_unset();
?>
rr