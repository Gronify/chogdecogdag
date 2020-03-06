<?php
$servername = "localhost";
$database = "cgk";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);

$teamid = $_POST['teamid'];

$query = mysqli_query($link,"SELECT user_login FROM users WHERE user_id = '".mysqli_real_escape_string($link, $_POST['teamid'])."' LIMIT 1");
$result = mysqli_fetch_assoc($query);

$team = $result['user_login'];
$answer = $_POST['answer'];
$correct = '2';
$query = mysqli_query($link, "SELECT * FROM whower WHERE teamid = 0 ORDER BY id DESC LIMIT 1");
$result = mysqli_fetch_assoc($query);
$gameid = $result['gameid'];
$questionid = $result['questionid'];
$question = $result['question'];
$questioncost = $result['questioncost'];


$sql = "INSERT INTO whower (teamid, team, answer, correct, gameid, questionid, question, questioncost) VALUES ('$teamid', '$team', '$answer', '$correct', '$gameid', '$questionid', '$question', '$questioncost')";
if (mysqli_query($link, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
mysqli_close($link);
?>