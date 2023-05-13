<?php
include "db_connect.php";
$id = $_GET["idProduct"];
$sql = "DELETE FROM `product` WHERE idProduct = $id";
$result = mysqli_query($conn, $sql);

$del = "DELETE FROM `variacao` WHERE idProduct = $id";
$result = mysqli_query($conn, $del);

if ($result) {
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}