<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($connect, "DELETE FROM bilik WHERE id = $id");

header("Location: index.php");
?>