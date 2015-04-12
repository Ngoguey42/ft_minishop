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
	function rm_item($id, $sql_ptr)
	{
		$ret = mysqli_query($sql_ptr, 'SELECT id FROM items WHERE id="'.$id.'";');
		if (mysqli_num_rows($ret) == 0)
			return false;
		$ret = mysqli_query($sql_ptr, 'DELETE FROM items WHERE id="'.$id.'";');
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
				if ($_SESSION['login'] !== 'root')
					load_index_php();
				if (isset($_GET["usrdel"]))
				{
					if ($_GET["usrdel"] === "1")
						save_action_and_reload_noget("Root cannot be removed");
					else if (rm_usr(mysqli_real_escape_string($sql_ptr, $_GET["usrdel"]), $sql_ptr))
						save_action_and_reload_noget("The user has been removed");
					else
						save_action_and_reload_noget("Error when trying to remove this user");
				}
				else if (isset($_GET["cmddel"]))
				{
					if (rm_cmd(mysqli_real_escape_string($sql_ptr, $_GET["cmddel"]), $sql_ptr))
						save_action_and_reload_noget("The command has been removed");
					else
						save_action_and_reload_noget("Error when trying to remove this command");
				}
				else if (isset($_GET["itemdel"]))
				{
					if (rm_item(mysqli_real_escape_string($sql_ptr, $_GET["itemdel"]), $sql_ptr))
						save_action_and_reload_noget("The item has been removed");
					else
						save_action_and_reload_noget("Error when trying to remove this item");
				}
			?>
			<div class="content-box">
				<a href="http://ft_minishop.local.42.fr:8080/admin" style="font-size: 20px; color: green;">Refresh</a>
				<!-- PRINT USERS -->
					<div style="font-weight: bold; font-size: 20px;text-decoration: underline; margin-top: 20px; margin-bottom: 10px;">Users:</div>
					<?php
						$ret = mysqli_query($sql_ptr, "SELECT * FROM users ;");
						while ($tab = mysqli_fetch_assoc($ret))
							echo '&nbsp;&nbsp;&#9679; '.$tab['login'].'&nbsp;<a href="?usrdel='.$tab['id'].'" style="font-size: 12px;">delete</a><br/>';
					?>
				<!--  -->
				<!-- PRINT COMMANDS -->
					<div style="font-weight: bold; font-size: 20px;text-decoration: underline; margin-top: 20px; margin-bottom: 10px;">Commands:</div>
					<?php
						$ret = mysqli_query($sql_ptr, "SELECT c.id, c.amount, c.user_id, u.login FROM commands c LEFT JOIN users u on c.user_id=u.id;");
						while ($tab = mysqli_fetch_assoc($ret))
						{
							if (!isset($tab['login']))
								$tab['login'] = 'unknow';
							echo '&nbsp;&nbsp;&#9679; #'.$tab['id'].'&nbsp;'.money_format('%!10.2n &euro;', (float)$tab['amount'] / 100.).'&nbsp;(user: '.$tab['user_id'].'&nbsp;'.$tab['login'].')&nbsp;'.'<a href="?cmddel='.$tab['id'].'" style="font-size: 12px;">delete</a><br/>';
						}
					?>
				<!--  -->
				<!-- PRINT ITEMS -->
					<div style="font-weight: bold; font-size: 20px;text-decoration: underline; margin-top: 20px; margin-bottom: 10px;">Items:</div>
					<?php
						$ret = mysqli_query($sql_ptr, "SELECT items.id, items.name, items.price, categories.name 'cat' FROM items LEFT JOIN categories on items.category_id = categories.id;");
						while ($tab = mysqli_fetch_assoc($ret))
							echo '&nbsp;&nbsp;&#9679; #'.$tab['id'].'&nbsp;'.$tab['name'].'&nbsp;'.money_format('%!10.2n &euro;', (float)$tab['price'] / 100.).'&nbsp;'.'(cat: '.$tab['cat'].')&nbsp;<a href="?itemdel='.$tab['id'].'" style="font-size: 12px;">delete</a><br/>';
					?>
				<!--  -->
			</div>
			<?php require($_SERVER['DOCUMENT_ROOT']."/footer.html"); ?>
		</div>
	</body>
</html>
