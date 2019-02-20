<?php include "connect.php"; ?>

<?php

$Qnumber = 1;
$quiz = rand (1,2); // Randomly generates quizID

$q = $pdo->query("select * from QuestionBank where QuizID = '$quiz'");
$r = $q->fetchAll();

shuffle($r); // Shuffles array

$json_array = json_encode($r);

echo $json_array;


?>