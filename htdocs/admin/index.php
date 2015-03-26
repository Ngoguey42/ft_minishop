<?php
	function rm_usr($id, $sql_ptr)
	{
		$ret = mysqli_query($sql_ptr, 'SELECT id FROM users WHERE id="'.$id.'";');
		if (mysqli_num_rows($ret) == 0)
			return false;
		$ret = mysqli_query($sql_ptr, 'DELETE FROM users WHERE id="'.$id.'";');
		return true;
	}
	function rm_cmd($id, $sql_ptr)
	{
		$ret = mysqli_query($sql_ptr, 'SELECT id FROM commands WHERE id="'.$id.'";');
		if (mysqli_num_rows($ret) == 0)
			return false;
		$ret = mysqli_query($sql_ptr, 'DELETE FROM commands WHERE id="'.$id.'";');
		return true;
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
			<?php
				require($_SERVER['DOCUMENT_ROOT']."/header.php"); 
				if (isset($_GET["usrdel"]))
				{
					if ($_GET["usrdel"] === "1")
						echo '<script>alert("Root cannot be removed !");</script>';
					else if (rm_usr(mysql_real_escape_string($_GET["usrdel"]), $sql_ptr))
						echo '<script>alert("The user has been removed.");</script>';
					else
						echo '<script>alert("Error when trying to remove this user...");</script>';
				}
				else if (isset($_GET["cmddel"]))
				{
					if (rm_cmd(mysql_real_escape_string($_GET["cmddel"]), $sql_ptr))
						echo '<script>alert("The command has been removed.");</script>';
					else
						echo '<script>alert("Error when trying to remove this command...");</script>';
				}
			?>
			<div class="content-box">

			<a href="http://ft_minishop.local.42.fr:8080/admin" style="font-size: 20px; color: green;">Refresh the data</a>
				<!-- PRINT USERS -->
				<div style="font-weight: bold; font-size: 20px;text-decoration: underline; margin-top: 20px; margin-bottom: 10px;">Users:</div>
				<?php
					$ret = mysqli_query($sql_ptr, "SELECT * FROM users ;");
					while ($tab = mysqli_fetch_assoc($ret))
						echo '&nbsp;&nbsp;• '.$tab['login'].'&nbsp;<a href="?usrdel='.$tab['id'].'" style="font-size: 12px;">delete</a><br/>';
				?>

				<!-- PRINT COMMANDS -->
				<div style="font-weight: bold; font-size: 20px;text-decoration: underline; margin-top: 20px; margin-bottom: 10px;">Commands:</div>
				<?php
					$ret = mysqli_query($sql_ptr, "SELECT c.id, c.amount, c.user_id, u.login FROM commands c LEFT JOIN users u on c.user_id=u.id;");
					while ($tab = mysqli_fetch_assoc($ret))
					{
						if (!isset($tab['login']))
							$tab['login'] = 'unknow';
						echo '&nbsp;&nbsp;• #'.$tab['id'].'&nbsp;'.money_format('%!10.2n &euro;', (float)$tab['amount'] / 100.).'&nbsp;(user: '.$tab['user_id'].'&nbsp;'.$tab['login'].')&nbsp;'.'<a href="?cmddel='.$tab['id'].'" style="font-size: 12px;">delete</a><br/>';
					}
				?>
			</div>
			<?php require($_SERVER['DOCUMENT_ROOT']."/footer.html"); ?>
		</div>
	</body>
</html>
