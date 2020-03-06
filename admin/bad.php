<?php

$servername = "localhost";
$database = "cgk";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);
mysqli_query($link, "UPDATE whower SET correct='0' WHERE id='".mysqli_real_escape_string($link, $_POST['id'])."'");
mysqli_close($link);

?>