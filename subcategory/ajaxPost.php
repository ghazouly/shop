<?php

$categoryId = $_POST['id'];
$subCategoryName = $_POST['name'];

if ($subCategoryName) {
		$dbConnection = mysqli_connect("localhost", "root", "", "shop");
		$query = "INSERT INTO subcategories(categoryId, subCategoryName) VALUES('$categoryId','$subCategoryName')";
		$result = mysqli_query($dbConnection,$query);
}
