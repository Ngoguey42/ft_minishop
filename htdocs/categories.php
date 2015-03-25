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
				CATEGORIE
				<?php 
				if (!isset($_GET['cat']))
					load_index_php();
				$request = "SELECT name FROM categories WHERE id='".
					mysql_real_escape_string($_GET['cat'])."';";
				$result = mysqli_query($sql_ptr, $request);
				echo "<br>";
				if (mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					echo $row['name'];
				}
				else
					load_index_php();
				$request = "SELECT id, name, price FROM items WHERE category_id='".
					mysql_real_escape_string($_GET['cat'])."';";
				$result = mysqli_query($sql_ptr, $request);
				echo "<br>";
				if (mysqli_num_rows($result) > 0)
				{
					$itemPage = "/item.php?id=";
					while ($row = mysqli_fetch_assoc($result))
					{
						echo '<a href="'.$itemPage.$row['id'].'">';
						var_dump($row);
						echo "</a><br>";
					}
				}
				?>
			</div>
			<?php require($_SERVER['DOCUMENT_ROOT']."/footer.html"); ?>
		</div>
	</body>
</html>
