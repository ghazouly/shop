<?php

$subCategoryId = $_POST['subCategoryId'];
$productName = $_POST['productName'];

if ($productName) {
  	$dbConnection = mysqli_connect("localhost", "root", "", "shop");
  	$query = "UPDATE products SET `productName` = '$productName' WHERE `subCategoryId` = '$subCategoryId'";
  	$result = mysqli_query($dbConnection,$query);
}
