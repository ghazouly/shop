<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SHOP</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
	<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
					<div class="navbar-header">

				<?php
				/*
				*		---------------------------------
				*		I. Login with rememberMe Cookie.
				*		---------------------------------
				*/

				//creating a session to consume POST request
				session_start();

				if(!empty($_POST["login"])) {

						//Database connection, quering and fetching loggedIn user.
						$dbConnection = mysqli_connect("localhost", "root", "", "shop");

						$userName = $_POST["userName"];
						$userPassword = md5($_POST["userPassword"]);

						$query = "SELECT * FROM users
								WHERE userName='$userName'
								AND use</div>rPassword='$userPassword'";
						$result = mysqli_query($dbConnection,$query);
						$user = mysqli_fetch_assoc($result);

						//validating login request.
						if($user) {
								$_SESSION["id"]	= $user["id"];
								$message = "Successful Login";

								//setting loggedIn user's cookie.
								if(!empty($_POST["remember"])) {
										setcookie ("userLogin",
												$_POST["userName"],
												time()+ (10 * 365 * 24 * 60 * 60));
										setcookie ("userPassword",
												$_POST["userPassword"],
												time()+ (10 * 365 * 24 * 60 * 60));
								}
								//retrieving existing one.
								else {
									if(isset($_COOKIE["userLogin"])) {
										setcookie ("userLogin","");
									}
									if(isset($_COOKIE["userPassword"])) {
										setcookie ("userPassword","");
									}
								}
						}
						//failed request.
						else {
							$message = "Invalid Login";
						}
				}
				?>

				<?php if(empty($_SESSION["id"])) { ?>
				<h3>I. Login with rememberMe Cookie.</h3>

						<form action="" method="post">
								<div><?php if(isset($message)) { echo $message; } ?></div><br>
						  <div class="form-group">
						    <label for="login">Username</label>
						    <input name="userName" type="text"
										value="<?php if(isset($_COOKIE["userLogin"]))	{ echo $_COOKIE["userLogin"]; } ?>"
										class="form-control" placeholder="Username">
						  </div>
						  <div class="form-group">
						    <label for="password">Password</label>
						    <input name="userPassword" type="password"
										value="<?php if(isset($_COOKIE["userPassword"])) { echo $_COOKIE["userPassword"]; } ?>"
										class="form-control" placeholder="Password">
						  </div>
						  <div class="checkbox">
						    <label for="remember-me">
						      <input type="checkbox">rememberMe
						    </label>
						  </div>
						  <button type="submit" name="login" value="Login" class="btn btn-default">Login</button>
						</form>


<?php } else { ?>
		<h3><b>You have Successfully logged in!.</b></h3>
		<br><hr><br>
<?php } ?>

		<h3>II. Categories CRUD</h3>
		<form id="categoriesForm">
			<input type="text" name="name" />
			<input type="submit" value="Add" />
		</form>

		<?php
		/*
		*		---------------------------------
		*		II. Categories CRUD
		*		---------------------------------
		*/
		$dbConnection = mysqli_connect("localhost", "root", "", "shop");
		$query = "SELECT * FROM categories";
		$result = mysqli_query($dbConnection,$query);
		$categories = mysqli_fetch_all($result);

		?>
    <div id="categories">
			  <table class="table table-bordered">
						<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Action</th>
						</tr>
						<?php foreach ($categories as $category) { ?>
						<div class="row<?php echo $category[0]; ?>">
						  <tr>
								<td>
									<?php echo $category[0]; ?>
								</td>
								<td>
										<input class="name" type="text" value="<?php echo $category[1]; ?>" name="categoryName" />
								</td>
								<td>
										<a href="#"
												class="update glyphicon glyphicon-edit"
												rel="<?php echo $category[0]; ?>"></a>
										<a href="#"
												class="delete glyphicon glyphicon-trash"
												rel="<?php echo $category[0]; ?>"></a>
								</td>
						  </tr>
            </div>
        		<?php } ?>
				</table>
		   </div>


				<br><hr><br>
				<h3>III. SubCategories CRUD</h3>
        <form id="subCategoriesForm">
          <select name="id">
          <?php
          $dbConnection = mysqli_connect("localhost", "root", "", "shop");
          $query = "SELECT id, categoryName FROM categories";
          $result = mysqli_query($dbConnection,$query);

          while ($row = $result->fetch_assoc()) {
              unset($id, $name);
              $id = $row['id'];
              $name = $row['categoryName'];
              echo '<option value="'.$id.'">'.$name.'</option>';
          } ?>
          </select>
          <input type="text" name="name" />
          <input type="submit" value="Add" />
        </form>

				<?php
				/*
				*		---------------------------------
				*		II. subCategories CRUD
				*		---------------------------------
				*/
				$dbConnection = mysqli_connect("localhost", "root", "", "shop");
				$query = "SELECT subcategories.id, subcategories.categoryId, subcategories.subcategoryName,
				 					categories.id, categories.categoryName
									FROM subcategories
											INNER JOIN categories
													ON subcategories.categoryId = categories.id;";
				$result = mysqli_query($dbConnection,$query);
				$subCategories = mysqli_fetch_all($result);

				?>
				<table class="table table-bordered">
						<tr>
								<th>ID</th>
								<th>Parent Category</th>
								<th>SubCategory Name</th>
								<th>Action</th>
						</tr>
						<?php foreach ($subCategories as $subCategory) { ?>
            <div class="row<?php echo $category[0]; ?>">
            <tr>
								<td><?php echo $subCategory[0]; ?></td>
                <td><input class="name" type="text" value="<?php echo $subCategory[4]; ?>" name="categoryName" /></td>
                <td><input class="name" type="text" value="<?php echo $subCategory[2]; ?>" name="subCategoryName" /></td>
								<td>
                  <a href="#"
                      class="update glyphicon glyphicon-edit"
                      rel="<?php echo $subCategory[0]; ?>"></a>
                  <a href="#"
                      class="delete glyphicon glyphicon-trash"
                      rel="<?php echo $subCategory[0]; ?>"></a>
								</td>
						</tr>
          </div>
						<?php } ?>
				</table>

				<br><hr><br>
				<h3>IV. Products CRUD</h3>
        <form id="productsForm">
          <select name="id">
          <?php
          $dbConnection = mysqli_connect("localhost", "root", "", "shop");
          $query = "SELECT id, subcategoryName FROM subCategories";
          $result = mysqli_query($dbConnection,$query);

          while ($row = $result->fetch_assoc()) {
              unset($id, $name);
              $id = $row['id'];
              $name = $row['subcategoryName'];
              echo '<option value="'.$id.'">'.$name.'</option>';
          } ?>
          </select>
          <input type="text" name="name" />
          <input type="submit" value="Add" />
        </form>

				<?php
				/*
				*		---------------------------------
				*		IV. Products CRUD
				*		---------------------------------
				*/
				$dbConnection = mysqli_connect("localhost", "root", "", "shop");
				$query = "SELECT products.id, products.subCategoryId, products.productName,
				 					subcategories.id, subcategories.subCategoryName,
				 					categories.id, categories.categoryName
									FROM products
											INNER JOIN subcategories
													ON products.subCategoryId = subcategories.id
											LEFT OUTER JOIN categories
													ON subcategories.categoryId = categories.id";
				$result = mysqli_query($dbConnection,$query);
				$products = mysqli_fetch_all($result);

				?>
				<table class="table table-bordered">
						<tr>
								<th>ID</th>
								<th>Category</th>
								<th>SubCategory</th>
								<th>Product Name</th>
								<th>Action</th>
						</tr>
						<?php foreach ($products as $product) { ?>
            <div class="row<?php echo $category[0]; ?>">
            <tr>
								<td><?php echo $product[0]; ?></td>
                <td><?php echo $product[6]; ?></td>
                <td><input class="name" type="text" value="<?php echo $product[4]; ?>" name="subCategoryName" /></td>
                <td><input class="name" type="text" value="<?php echo $product[2]; ?>" name="productName" /></td>
								<td>
                  <a href="#"
                      class="update glyphicon glyphicon-edit"
                      rel="<?php echo $product[0]; ?>"></a>
                  <a href="#"
                      class="delete glyphicon glyphicon-trash"
                      rel="<?php echo $product[0]; ?>"></a>
								</td>
						</tr>
            </div>
						<?php } ?>
				</table>



		  </div>
	  </div>
 	</nav>
</body>

<script>

<!--
/*
*		---------------------------------
*		I. Categories CRUD
*		---------------------------------
*/
-->
$(document).ready(function() {
	$("#categoriesForm").submit(function() {
		$.post('category/ajaxPost.php', $('#categoriesForm').serialize(), function() {
			$('#categories').load(location.href);
		});
		return false;
	});

	$('.update').click(function() {
		var item = $(this).parent();
		var id = $(this).attr('rel');
		var name = $('.row' + id + ' .name').val();

		$.post('category/ajaxUpdate.php', {
			'id' : id,
			'name' : name,
		});
	});

	$('.delete').click(function() {
		var item = $(this).parent();
		var id = $(this).attr('rel');

		$.post('category/ajaxDelete.php', {
			'id' : id
		}, function() {
			$(item).hide();
		});
	});
});
<!--
/*
*		---------------------------------
*		II. SubCategories CRUD
*		---------------------------------
*/
-->
$(document).ready(function() {
	$("#subCategoriesForm").submit(function() {
		$.post('subcategory/ajaxPost.php', $('#subCategoriesForm').serialize(), function() {
			$('#categories').load(location.href);
		});
		return false;
	});

	$('.update').click(function() {
		var item = $(this).parent();
		var id = $(this).attr('rel');
		var name = $('.row' + id + ' .name').val();

		$.post('subcategory/ajaxUpdate.php', {
			'id' : id,
			'name' : name,
		});
	});

	$('.delete').click(function() {
		var item = $(this).parent();
		var id = $(this).attr('rel');

		$.post('subcategory/ajaxDelete.php', {
			'id' : id
		}, function() {
			$(item).hide();
		});
	});
});
<!--
/*
*		---------------------------------
*		III. Products CRUD
*		---------------------------------
*/
-->
$(document).ready(function() {
	$("#productsForm").submit(function() {
		$.post('product/ajaxPost.php', $('#productsForm').serialize(), function() {
			$('#categories').load(location.href);
		});
		return false;
	});

	$('.update').click(function() {
		var item = $(this).parent();
		var id = $(this).attr('rel');
		var name = $('.row' + id + ' .name').val();

		$.post('product/ajaxUpdate.php', {
			'id' : id,
			'name' : name,
		});
	});

	$('.delete').click(function() {
		var item = $(this).parent();
		var id = $(this).attr('rel');

		$.post('product/ajaxDelete.php', {
			'id' : id
		}, function() {
			$(item).hide();
		});
	});
});
	</script>
</html>
