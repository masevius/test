<?php
require_once 'settings.php';
//$opened_file = fopen(path_files . '/' . $_GET['file'], "r+");
$opened_file = fopen(path_files . '/' . $_GET['file'], $_GET['mode']);
echo '<a href="' . path_web . '">Вернуться на главную</a><br><br>';
$text = fpassthru($opened_file);
echo $text;
switch ($_GET['status']) {
    case 'edit':
        ?>
        <form method="post">
            <textarea  rows="20" cols="50" name="editing">
                <?php
                readfile(path_files . '/' . $_GET['file']);
                ?>
            </textarea>
            <br><input type="submit" value="Отправить">
        </form>

        <?php
        if (!empty($_POST['editing'])) {
//            echo $_POST['editing'];
            fwrite($opened_file, $_POST['editing']);
        }

        break;
    case 'read':
        readfile(path_files . '/' . $_GET['file']);
        break;
    default:
        break;
}
?>