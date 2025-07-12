<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "diabet_web";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Lidhja me databazë dështoi: " . $conn->connect_error);
}
?>
