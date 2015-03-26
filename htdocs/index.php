<?php
function newusr_check_input($sql_ptr)
{
	if (!preg_match("/^([0-9A-Za-z]*)$/", $_POST['login']))
		return 'Login';
	if (!preg_match("/^([0-9A-Za-z]*)$/", $_POST['password']))
		return 'Password';
	if (!preg_match("/^([A-Za-z]*)$/", $_POST['lastname']))
		return 'Lastname';
	if (!preg_match("/^([A-Za-z]*)$/", $_POST['firstname']))
		return 'Firstname';
	if (!preg_match("/^([0-9A-Za-z ]*)$/", $_POST['address']))
		return 'Address';
	if (!preg_match("/^([0-9]{5})$/", $_POST['zipcode']))
		return 'Zipcode';
	if (!preg_match("/^([A-Za-z]*)$/", $_POST['city']))
		return 'City';
	$_POST['login'] = mysqli_real_escape_string($sql_ptr, $_POST['login']);
	$_POST['password'] = mysqli_real_escape_string($sql_ptr, $_POST['password']);
	$_POST['lastname'] = mysqli_real_escape_string($sql_ptr, $_POST['lastname']);
	$_POST['firstname'] = mysqli_real_escape_string($sql_ptr, $_POST['firstname']);
	$_POST['address'] = mysqli_real_escape_string($sql_ptr, $_POST['address']);
	$_POST['zipcode'] = mysqli_real_escape_string($sql_ptr, $_POST['zipcode']);
	$_POST['city'] = mysqli_real_escape_string($sql_ptr, $_POST['city']);
	return NULL;
}
function newusr_create_user($sql_ptr)
{
	$ret = mysqli_query($sql_ptr, 'SELECT login FROM users WHERE login="'.$_POST["login"].'";');
	if (mysqli_num_rows($ret) == 0)
	{
		$ret = mysqli_query($sql_ptr, "INSERT INTO `users` (id, login, password, lastname, firstname, address, zipcode, city, admin) VALUES (NULL, '".$_POST["login"]."', '".hash("Whirlpool", $_POST["password"])."', '".$_POST["lastname"]."', '".$_POST["firstname"]."', '".$_POST["address"]."', '".$_POST["zipcode"]."', '".$_POST["city"]."', 0);");
		echo '<script>alert("User created, you can now connect yourself.");</script>';
	}
	else
		echo '<script>alert("The login already exist.");</script>';
}
function newusr($sql_ptr)
{
	if (empty($_POST['login']) || empty($_POST['password']) 
	|| empty($_POST['lastname']) || empty($_POST['firstname'])
	|| empty($_POST['address'])|| empty($_POST['zipcode'])
	|| empty($_POST['city']))
		echo '<script>alert("Please fill all the fields !");</script>';
	else if (($err = newusr_check_input($sql_ptr)) === NULL)
		newusr_create_user($sql_ptr);
	else
		echo '<script>alert("'.$err.' is invalid !");</script>';
}
function connectusr_sqlcomp($sql_ptr)
{
	$ret = mysqli_query($sql_ptr, 'SELECT * FROM users WHERE login="'.$_POST["login"].'" AND password="'.hash("Whirlpool", $_POST["password"]).'";');
	if (mysqli_num_rows($ret) == 0)
		return false;
	return true;
}
function connectusr_check_input($sql_ptr)
{
	$_POST['login'] = mysqli_real_escape_string($sql_ptr, $_POST['login']);
	$_POST['password'] = mysqli_real_escape_string($sql_ptr, $_POST['password']);
	if (!preg_match("/^([0-9A-Za-z]*)$/", $_POST['login']) || !preg_match("/^([0-9A-Za-z]*)$/", $_POST['password']))
		return false;
	return true;
}
function connectusr($sql_ptr)
{
	if (empty($_POST['login']) || empty($_POST['password']))
		echo '<script>alert("Please fill all the fields !");</script>';
	else if (!($err = connectusr_check_input($sql_ptr)) || !connectusr_sqlcomp($sql_ptr))
		echo '<script>alert("Wrong combinaison login/password !");</script>';
	else
	{
		// CONNECT THE USER
		echo '<script>alert("You are logged in");</script>';		
	}	
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
			<?php
			if (isset($_POST['submit_type']))
			{
				if ($_POST['submit_type'] === 'newusr')
					newusr($sql_ptr);
				else if ($_POST['submit_type'] === 'connect')
					connectusr($sql_ptr);
			}
			?>
			<h2>NEW USER:</h2>
			<form method="POST">
				<input type="hidden" name="submit_type" value="newusr" />
				<input type="text" name="login" placeholder="login" /><br/>
				<input type="password" name="password" placeholder="password" /><br/>
				<input type="text" name="lastname" placeholder="lastname" /><br/>
				<input type="text" name="firstname" placeholder="firstname" /><br/>
				<input type="text" name="address" placeholder="address" /><br/>
				<input type="number" name="zipcode" placeholder="zipcode" /><br/>
				<input type="text" name="city" placeholder="city" /><br/><br/>
				<input type="submit" value="Submit" />
			</form>
			<br/><h2>CONNECTION:</h2>
			<form method="POST">
				<input type="hidden" name="submit_type" value="connect" />
				<input type="text" name="login" placeholder="login" /><br/>
				<input type="password" name="password" placeholder="password" /><br/><br/>
				<input type="submit" value="Submit" />
			</form>
		</div>
		<?php require($_SERVER['DOCUMENT_ROOT']."/footer.html"); ?>
	</div>
</body>
</html>
