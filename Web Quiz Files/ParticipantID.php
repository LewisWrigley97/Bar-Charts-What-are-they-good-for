<?php include "connect.php"; ?>

<?php

$q = $pdo->query('SELECT ParticipantID FROM Participant ORDER BY ParticipantID DESC LIMIT 1');
$r = $q->fetchAll();

$json_array = json_encode($r);

echo $json_array;


?>