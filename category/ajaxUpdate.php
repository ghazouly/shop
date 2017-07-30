<?php

$categoryId = $_POST['id'];
$categoryName = $_POST['name'];

if ($categoryName) {
  	$dbConnection = mysqli_connect("localhost", "root", "", "shop");
  	$query = "UPDATE messages SET `categoryName` = '$categoryName' WHERE `id` = '$categoryId'";
  	$result = mysqli_query($dbConnection,$query);
}
