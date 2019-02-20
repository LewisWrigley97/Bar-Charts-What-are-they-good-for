<?php include "connect.php"; ?>

<?php

$q = $pdo->query("select * from Code");
$r = $q->fetchAll();


$json_array = json_encode($r);

echo $json_array;


?>