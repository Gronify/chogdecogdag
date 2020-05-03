<?php
// Страница авторизации

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

$servername = "localhost";
$database = "cgk";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password']))){
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!empty($_POST['not_attach_ip'])){
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php"); exit();
    }
    else{
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<html>
<head>
    <title>Что? Где? Когда?</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">

      <main role="main" class="inner cover mt-5">
	  <section>
			<h1>Что? Где? Когда?</h1>
            <form method="POST">
                <div class="form-group">
                    <label>Логин</label>
                    <input name="login" type="text" required>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input name="password" type="password" required>
                </div>
                <div class="form-group check-group">
                    <input type="checkbox" class="form-check-input" name="not_attach_ip">
                    <label class="form-check-label" >Не прикреплять к IP(небезопасно)</label>
                </div>
                <input name="submit" class="btn btn-lg btn-success" type="submit" value="Войти">
                <input type="button" class="btn btn-lg btn-primary" value="Зарегистрироваться" onClick='location.href="register.php"'>

            </form>
		</section>

      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Prealfa build, by <a href="#">gaysexteam</a>.</p>
        </div>
      </footer>
    </div>
</body>
</html>