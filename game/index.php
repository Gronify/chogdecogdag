<?php
// Скрипт проверки

$servername = "localhost";
$database = "cgk";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    
}

?>
<html>
<head>
    <title>Что? Где? Когда?</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="../js/main.js"></script>
</head>
<body>
    <div class="header">
        <div id="header"><h1 class="text-center">Что? Где? Когда?</h1></div>
    </div>
    <div class="text-center" class="container" style="margin-top: 50px;"  >
        Команда:<?php echo $userdata['user_login']; ?>
        <b><div id="question" style="font-size: 20px;" ></div></b>

        <form>
            <p style="font-size: 13px;">Введите ваш ответ:</p>
            <p><textarea id="answer" rows="5" cols="45" name="text" placeholder="Введите ответ"></textarea></p>
            <p><input type="button" value="Отправить" onclick="AjaxFormRequest()"></p>
        </form>
    </div>


</body>
</html>
