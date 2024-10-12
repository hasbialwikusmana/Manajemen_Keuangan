<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_keuangan";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
  die("Koneksi gagal: " . $mysqli->connect_error);
}
