<?php

$categoryId = $_POST['categoryId'];
$subCategoryName = $_POST['subCategoryName'];

if ($subCategoryName) {
  	$dbConnection = mysqli_connect("localhost", "root", "", "shop");
  	$query = "UPDATE subcategories SET `subCategoryName` = '$subCategoryName' WHERE `categoryId` = '$categoryId'";
  	$result = mysqli_query($dbConnection,$query);
}
