<?php
// Скрипт проверки

$servername = "localhost";
$database = "cgk";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = 3 LIMIT 1");
    $admindata = mysqli_fetch_assoc($query);


    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
    or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!

        header("Location: ../login.php"); exit();
    }
    else
    {
        if(($userdata['user_hash'] !== $admindata['user_hash']) or ($userdata['user_id'] !== $admindata['user_id'])
        or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
         {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!

        header("Location: ../login.php"); exit();
         }
        
    }
}
else
{
    header("Location: ../login.php"); exit();
}
?>
<html>
<head>
    <title>Что? Где? Когда?</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="../js/adminjs.js"></script>
</head>
<body>
    <div class="header">
        <div id="header" class="text-center">
            <h1 class="text-center">Что? Где? Когда?</h1>
            <input  type="button" value="Новая игра" onclick="newgame()">
            <a href="endgame.php"><input  type="button" value="Итог игры" onclick=""></a>
        </div>

    </div>
    

    <div class="text-center" class="container" style="margin-top: 50px;"  >
        Ведущий: <?php echo $userdata['user_login']; ?></br>
        <form>
        <p><textarea id="questionid" rows="1" cols="45" name="text" placeholder="Номер вопроса">0</textarea></p>
        <p><textarea id="questionv" rows="2" cols="45" name="text" placeholder="Введите вопрос(необезательно)"></textarea></p>
        <p><textarea id="answer" rows="2" cols="45" name="text" placeholder="Введите ответ(необезательно)"></textarea></p>
        <p><textarea id="questioncost" rows="1" cols="45" name="text" placeholder="Стоимость вопроса"> 0 </textarea></p>
        <p><input type="button" value="Задать вопрос" onclick="AjaxFormRequest()"></p>
        </form>

        <b><div class="container" id="question"></div></b>
        

        
    </div>


</body>
</html>