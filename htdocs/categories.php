<!doctype html>
<html>
	<head>
		<title>ft_minishop</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/ft_minishop.css">
	</head>
	<body>
		<div class="main-box">
			<?php require("header.html"); ?>
			<div class="content-box">












				<CENTER>CATEGORIE				<?php echo $_GET['cat'] ?></CENTER>
				<?php 
				if (!($toto = mysqli_connect("localhost:3306", "root", "qwerty")))
					echo "toto ko";
				else
					echo "toto ok";
				$titi = $_GET['cat'];
				mysqli_query($toto, "use rush00 ;");
				$ret = mysqli_query($toto, "SELECT * FROM categories;");
				while ($data = mysqli_result($ret)) {
					var_dump($data);
				}
				mysqli_close($toto);
				 ?>












			</div>
			<?php require("footer.html"); ?>
		</div>
	</body>
</html>
