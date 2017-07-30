<?php

$id = $_POST['id'];
$productName = $_POST['name'];

if ($productName) {
  	$dbConnection = mysqli_connect("localhost", "root", "", "shop");
  	$query = "UPDATE products SET `productName` = '$productName' WHERE `id` = '$id'";
  	$result = mysqli_query($dbConnection,$query);
}
