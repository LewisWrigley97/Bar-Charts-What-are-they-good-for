<?php

try {
$pdo = new PDO('', '', '');
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1);
}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>