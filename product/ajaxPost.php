<?php

$subCategoryId = $_POST['subCategoryId'];
$productName = $_POST['productName'];

if ($productName) {
		$dbConnection = mysqli_connect("localhost", "root", "", "shop");
		$query = "INSERT INTO products(subCategoryId, productName) VALUES('$subCategoryId','$productName')";
		$result = mysqli_query($dbConnection,$query);
}
