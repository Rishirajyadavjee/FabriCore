<?php
$host='127.0.0.1'; $user='root'; $pass=''; $db='fabric_ai';
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_errno) { error_log('DB err: '.$conn->connect_error); }
?>
