
<?php
// Соединяемся, выбираем базу данных
$link = mysqli_connect('localhost', 'root', '', 'cgk')
or die('Не удалось соединиться: ' . mysql_error());
//echo 'Соединение успешно установлено';

// Выполняем SQL-запрос
$query = 'SELECT questionid FROM whower WHERE teamid = 0 ORDER BY id DESC LIMIT 1';
$result = mysqli_query($link,$query) or die('Запрос не удался: ' . mysqli_error($link));


$query = mysqli_query($link,"SELECT * FROM whower WHERE teamid = 0 ORDER BY id DESC LIMIT 1");
$result = mysqli_fetch_assoc($query);

$gameid = $result['gameid'];
$questionid = $result['questionid'];

$query = mysqli_query($link,"SELECT * FROM whower WHERE  gameid = '$gameid' AND questionid = '$questionid' ORDER BY id");


if ($result = $query) {
	echo "<table><tr><th> id </th><th> Команда </th><th> Ответ </th><th> Номер вопроса </th><th> Вопрос </th><th>Стоимость вопроса </th> <th> Верно/Неверно </th></tr>";


    /* извлечение ассоциативного массива */
    while ($row = mysqli_fetch_assoc($result)) {
    	echo "<tr>";
    	if ($row["correct"] == '2') {
    		printf ("<td>%s</td> <td>%s</td>  <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>Ожидание..</td> <td><input type=\"button\" value=\"+\" onclick=\"good('".$row["id"]."')\"><input type=\"button\" value=\"-\" onclick=\"bad('".$row["id"]."')\"></td>", $row["teamid"], $row["team"], $row["answer"], $row["questionid"], $row["question"], $row["questioncost"], $row["correct"]);
    	}elseif ($row["correct"] == '1') {
    		printf ("<td>%s</td> <td>%s</td>  <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>Верно</td> <td><input type=\"button\" value=\"+\" onclick=\"good('".$row["id"]."')\"><input type=\"button\" value=\"-\" onclick=\"bad('".$row["id"]."')\"></td>", $row["teamid"], $row["team"], $row["answer"], $row["questionid"], $row["question"], $row["questioncost"], $row["correct"]);
    	}elseif ($row["correct"] == '0') {
    		printf ("<td>%s</td> <td>%s</td>  <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>Неверно</td> <td><input type=\"button\" value=\"+\" onclick=\"good('".$row["id"]."')\"><input type=\"button\" value=\"-\" onclick=\"bad('".$row["id"]."')\"></td>", $row["teamid"], $row["team"], $row["answer"], $row["questionid"], $row["question"], $row["questioncost"], $row["correct"]);
    	
    	}else{
        printf ("<td>%s</td> <td>%s</td>  <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td>", $row["teamid"], $row["team"], $row["answer"], $row["questionid"], $row["question"], $row["questioncost"], $row["correct"]);
    	}
        echo "</tr>";
    }
    echo "</table>";
//,  
    /* удаление выборки */
    mysqli_free_result($result);
}
/*
$query = "SELECT idteam, team, answer, question, questioncost FROM whower WHERE gameid = '$gameid' AND questionid = '$questionid' ORDER BY id ";
$result = mysqli_query($link,$query) or die('Запрос не удался: ' . mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    echo "<table><tr><th>id</th><th>idteam</th><th>team</th><th>answer</th><th>correct</th><th>gameid</th><th>questionid</th><th>question</th><th>questioncost</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {

        $row = mysqli_fetch_row($result);
        echo "<tr>";
        for ($j = 0 ; $j < 9 ; ++$j) echo "<td>$row[$j]</td>";
            echo "</tr>";
    }
    echo "</table>";
    
}
*/



// Закрываем соединение
mysqli_close($link);
?>