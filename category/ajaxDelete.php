<?php

$id = $_POST['id'];

if ($categoryName) {
  	$dbConnection = mysqli_connect("localhost", "root", "", "shop");
  	$query = "DELETE FROM categories WHERE `id` = '$id'";
  	$result = mysqli_query($dbConnection,$query);
}
