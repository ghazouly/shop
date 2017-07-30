<?php

$id = $_POST['id'];

if ($id) {
    $dbConnection = mysqli_connect("localhost", "root", "", "shop");
  	$query = "DELETE FROM products WHERE `id` = '$id'";
  	$result = mysqli_query($dbConnection,$query);
}
