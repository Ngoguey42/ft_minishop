<!doctype html>
<html>
	<head>
		<title>ft_minishop</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/ft_minishop.css">
	</head>
	<body>
		<div class="main-box">
			<?php require($_SERVER['DOCUMENT_ROOT']."/header.php"); ?>
			<div class="content-box">
				ITEM
				<?php 
				if (!isset($_GET['id']))
					load_index_php();
				$request = "SELECT * FROM items WHERE id='".
					mysql_real_escape_string($_GET['id'])."';";
				$result = mysqli_query($sql_ptr, $request);
				echo "<br>";
				if (mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					var_dump($row);;
				}
				else
					load_index_php();
				?>
			</div>
			<?php require($_SERVER['DOCUMENT_ROOT']."/footer.html"); ?>
		</div>
	</body>
</html>
