<?php
// Соединяемся, выбираем базу данных
$link = mysqli_connect('localhost', 'root', '', 'cgk')
or die('Не удалось соединиться: ' . mysql_error());
//echo 'Соединение успешно установлено';

// Выполняем SQL-запрос
$query = 'SELECT * FROM whower WHERE teamid = 0 ORDER BY id DESC LIMIT 1';
$result = mysqli_query($link,$query) or die('Запрос не удался: ' . mysqli_error($link));

// Выводим результаты в html

if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    echo "<table><tr><th>idteam</th><th>team</th><th>answer</th><th>correct</th><th>gameid</th><th>questionid</th><th>question</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
        for ($j = 0 ; $j < 8 ; ++$j) echo "<td>$row[$j]</td>";
            echo "</tr>";
    }
    echo "</table>";
}

// Освобождаем память от результатаыввы
mysqli_free_result($result);

// Закрываем соединение
mysqli_close($link);
?>