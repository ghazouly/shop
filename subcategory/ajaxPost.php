<?php

$categoryId = $_POST['categoryId'];
$subCategoryName = $_POST['subCategoryName'];

if ($subCategoryName) {
		$dbConnection = mysqli_connect("localhost", "root", "", "shop");
		$query = "INSERT INTO subcategories(categoryId, subCategoryName) VALUES('$categoryId','$subCategoryName')";
		$result = mysqli_query($dbConnection,$query);
}
