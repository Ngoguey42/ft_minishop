<!doctype html>
<html>
	<head>
		<title>ft_minishop</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/ft_minishop.css">
	</head>
	<body>
		<div class="main-box">
			<?php require($_SERVER['DOCUMENT_ROOT']."/header.html"); ?>
			<div class="content-box">












				<CENTER>CATEGORIE				<?php echo $_GET['cat'] ?></CENTER>
				<?php 
				
				/* if (!($toto = mysqli_connect("localhost:3306", "root", "qwerty")))
				   echo "toto ko";
				   else
				   echo "toto ok";
				   echo "lol";
				   $titi = $_GET['cat'];
				   echo "lol";
				   /* mysqli_query($toto, "use rush00 ;"); */
				/* echo "lol"; */
				/* $ret = mysqli_query($toto, "SELECT * FROM categories;"); */ 
				

				?>
			</div>
			<?php require($_SERVER['DOCUMENT_ROOT']."/footer.html"); ?>
		</div>
	</body>
</html>
