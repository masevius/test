<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
//        print_r($_GET);
        $news = 'Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
        $news = explode("\n", $news);

        function whereprint($answer) {//проверяет в зависимости от id выводить ли все новости или одну
            global $news;
            if ($answer == 'all' || $answer > count($news)) {
                foreach ($news as $id => $value) {
                    echo $value;
//                    header("HTTP/1.0 404 Not Found");
                }
            } else {
                echo $news[$answer - 1];
            }
        }

        function existparam() {//проверна на предмет наличия параметра id и не пустой ли он
            if (array_key_exists('id', $_GET) == false || $_GET['id']==NULL) {
                header('HTTP/1.0 404 NOT FOUND');
                echo '<h3>Новость, которую вы ищите отсутсвтует на сайте</h3><br/>';
                echo '<a href="/lesson5_1.php?id=all">Все новости';
                exit;
            }
        }

        existparam();
        whereprint($_GET['id']);
        ?>
    </body>
</html>
