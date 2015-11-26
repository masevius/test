<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'settings.php';
        $list_names = scandir(path_files);
        echo '<table border="1px">';
        foreach ($list_names as $name) {
            if (!is_dir($name)) {
                echo '<tr>';
                echo '<td><a href="' . path_web . '/change_file.php?status=read&file=' . $name . '&mode=r">' . $name . '</a></td><br>';
                echo '<td><a href="' . path_web . '/change_file.php?status=edit&file=' . $name . '&mode=r+"> Редактировать</a></td><br>';
//                echo '<td><a href="' . path_web . '/change_file.php?status=delete&file=' . $name . '&mode=delete"> Редактировать</a></td><br>';
                echo '</tr>';
            }
        }
        echo '</table>';
        ?>
    </body>
</html>
