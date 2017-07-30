<?php

$id = $_POST['id'];
$subCategoryName = $_POST['name'];

if ($subCategoryName) {
  	$dbConnection = mysqli_connect("localhost", "root", "", "shop");
  	$query = "UPDATE subcategories SET `subCategoryName` = '$subCategoryName' WHERE `id` = '$id'";
  	$result = mysqli_query($dbConnection,$query);
}
