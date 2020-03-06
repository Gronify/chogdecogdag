
<?php
// Соединяемся, выбираем базу данных
$link = mysqli_connect('localhost', 'root', '', 'cgk')
or die('Не удалось соединиться: ' . mysql_error());
//echo 'Соединение успешно установлено';

// Выполняем SQL-запрос
$query = 'SELECT questionid FROM whower WHERE teamid = 0 ORDER BY id DESC LIMIT 1';
$result = mysqli_query($link,$query) or die('Запрос не удался: ' . mysqli_error($link));

// Выводим результаты в html

if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    $row = mysqli_fetch_row($result);

    echo "Вопрос № $row[0]";
   
    
}

// Освобождаем память от результатаыввы
mysqli_free_result($result);

// Закрываем соединение
mysqli_close($link);
?>