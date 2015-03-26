<?php
function check_input()
{
	$_POST['login'] = mysql_real_escape_string($_POST['login']);
	$_POST['password'] = mysql_real_escape_string($_POST['password']);
	$_POST['last-name'] = mysql_real_escape_string($_POST['last-name']);
	$_POST['first-name'] = mysql_real_escape_string($_POST['first-name']);
	$_POST['address'] = mysql_real_escape_string($_POST['address']);
	$_POST['zipcode'] = mysql_real_escape_string($_POST['zipcode']);
	$_POST['city'] = mysql_real_escape_string($_POST['city']);
	if (!preg_match("/^([0-9A-Za-z]*)$/", $_POST['login']))
		return 'Login';
	if (!preg_match("/^([0-9A-Za-z]*)$/", $_POST['password']))
		return 'Password';
	if (!preg_match("/^([A-Za-z]*)$/", $_POST['last_name']))
		return 'Last-name';
	if (!preg_match("/^([A-Za-z]*)$/", $_POST['first_name']))
		return 'First-name';
	if (!preg_match("/^([0-9A-Za-z]*)$/", $_POST['address']))
		return 'Address';
	if (!preg_match("/^([0-9]{5})$/", $_POST['zipcode']))
		return 'Zipcode';
	if (!preg_match("/^([A-Za-z]*)$/", $_POST['city']))
		return 'City';
	return NULL;
}
function create_newusr($sql_ptr)
{
	$ret = mysqli_query($sql_ptr, 'SELECT login FROM users WHERE login="'.$_POST["login"].'";');
	if (mysqli_num_rows($ret) == 0)
	{
		$ret = mysqli_query($sql_ptr, "INSERT INTO `users` (id, login, password, lastname, firstname, address, zipcode, city, admin) VALUES (NULL, 'toto', 'qwerty', 'toto', 'titi', 't', 59300, 'rt', 0);");
		echo '<script>alert("User created, you can now connect yourself.");</script>';
	}
	else
		echo '<script>alert("The login already exist.");</script>';
}
?>
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
			<!-- NEW USER -->
				<?php 
				if (isset($_POST['submit_type']) && $_POST['submit_type'] === 'newusr')
				{
					if (!isset($_POST['login']) || !isset($_POST['password']) 
					|| !isset($_POST['last_name']) || !isset($_POST['first_name'])
					|| !isset($_POST['address'])|| !isset($_POST['zipcode'])
					|| !isset($_POST['city']))
						echo '<script>alert("Please fill all the fields !");</script>';
					else if (($err = check_input()) === NULL)
						create_newusr($sql_ptr);
					else
						echo '<script>alert("'.$err.' is invalid !");</script>';
				}
				?>
				<h2>NEW USER:</h2>
				<form method="POST">
					<input type="hidden" name="submit_type" value="newusr" />
					<input type="text" name="login" placeholder="login" /><br/>
					<input type="password" name="password" placeholder="password" /><br/>
					<input type="text" name="last name" placeholder="last_name" /><br/>
					<input type="text" name="first name" placeholder="first_name" /><br/>
					<input type="text" name="address" placeholder="address" /><br/>
					<input type="number" name="zipcode" placeholder="zipcode" /><br/>
					<input type="text" name="city" placeholder="city" /><br/><br/>
					<input type="submit" value="Submit" />
				</form>
			<!--  -->
		</div>
		<?php require($_SERVER['DOCUMENT_ROOT']."/footer.html"); ?>
	</div>
</body>
</html>
