<?php

$categoryName = $_POST['name'];

if ($categoryName) {
		$dbConnection = mysqli_connect("localhost", "root", "", "shop");
		$query = "INSERT INTO categories(categoryName) VALUES('$categoryName')";
		$result = mysqli_query($dbConnection,$query);
}
