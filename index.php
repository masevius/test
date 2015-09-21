<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Задание 1
echo '<h2>Задание 1 - выполнено </h2>';
    $name = 'Виктор';
    $age = 25;
echo 'Меня зовут ' . $name . '<br> Мне ' . $age . ' лет<br><br> ';
    
    
 echo 'Переменная $name ДО удаления - '.$name.'<br>';
    unset($name);
    $name=' ';
 echo 'Переменная $name ПОСЛЕ удаления  - '.$name.'<br><br>';
 
 echo 'Переменная $age ДО удаления - '.$age.'<br>';
    unset($age);
    $age=' ';
 echo 'Переменная $age ПОСЛЕ удаления - '.$age.'<br><br>';
 echo '<hr>';
 
// Задание 2
 echo '<h2>Задание 2 - выполнено</h2>';
 define('city', 'Подольск');
 var_dump(city);
 echo 'Значение константы city - '.city;
 echo '<br> Значение константы изменить нельзя, поэтому задание 2 - выполнено :)';
 echo '<hr>';
 
 //Задание 3
 
 echo '<h2>Задание 3 - выполнено</h2>';
 $book=array('title'=>'Дизайн Вашей квартиры','author'=>'Сафина','pages'=>'177');
  echo 'Недавно я прочитал книгу '.$book['title'].' написанную автором - '.$book['author'].' , я осилил '. $book['pages'].' страниц, мне
         она очень понравилась.';
   echo '<hr>';
  //задание 4
  echo '<h2>Задание 4 - выполнено!!</h2>';
  $books=array($book1=array('title1'=>'Дизайн Вашей квартиры','author1'=>'Сафина','pages1'=>'177'),$book2=array('title2'=>'php для чайников','author2'=>'Джанет Валейд','pages2'=>'317'));
 
  echo 'Написанные соответственно авторами '. $book1['author1'].' и '. $book2['author2'].'  я осилил в сумме '.  ($book1['pages1']+$book2['pages2']).'  страниц, не ожидал от себя подобного';
  
  ?>
