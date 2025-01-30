<?php
$mysqli = new mysqli("localhost", "root", "", "simawi");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
echo "Koneksi berhasil!";
?>
