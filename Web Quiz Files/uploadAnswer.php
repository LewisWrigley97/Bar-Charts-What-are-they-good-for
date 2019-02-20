<?php include "connect.php"; ?>

<?php


$qID=$_POST['QID'];
$pID=$_POST['PID'];
$answer=$_POST['answer'];
$qNo=$_POST['qNo'];
$time=$_POST['Time'];
$sql = "INSERT INTO Answers (QuestionID, ParticipantID, Answer, Time, QuestionNo) 
VALUES ('$qID', '$pID', '$answer', '$time', '$qNo')";
    
$pdo->exec($sql);

echo 'success';

?>