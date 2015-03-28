<?php
	$cart;
	function load_cart(&$cart, $sql_ptr)
	{
		if (empty($_SESSION['cart']))
			$_SESSION['cart'] = NULL;
		$cart = explode(";", $_SESSION['cart']);
	}
	function print_cart($sql_ptr)
	{
		var_dump($_SESSION['cart']);
	}
	function add_to_cart(&$cart)
	{
		$cart[] = $_GET['id'];
		$_SESSION['cart'] = implode(";", $cart);
		echo '<script>alert("Added to cart.");</script>';
	}
	function clear_cart()
	{
		$_SESSION['cart'] = NULL;
		echo '<script>alert("The cart has been cleared.");</script>';
	}
	function checkout_cart($sql_ptr)
	{
		if (empty($_SESSION['cart']))
		{
			echo '<script>alert("Nothing to checkout...");</script>';
			return ;
		}
		if (empty($_SESSION['login']))
		{
			echo '<script>alert("You must be connected to checkout !");</script>';
			return ;
		}
		if (($cmd_usr_id = mysqli_query($sql_ptr, 'SELECT id FROM users WHERE login="'.$_SESSION['login'].'";')) === false)
		{
			echo '<script>alert("Cannot checkout (mySQL error)");</script>';
			return ;			
		}
		$cmd_usr_id = mysqli_fetch_assoc($cmd_usr_id);
		$cmd_total = 0;
		$unserlz_cart = explode(";", $_SESSION['cart']);
		foreach ($unserlz_cart as $k)
		{
			if (($ret = mysqli_query($sql_ptr, 'SELECT price FROM items WHERE id="'.$k.'";')) === false)
			{
				echo '<script>alert("Cannot checkout (mySQL error)");</script>';
				return ;
			}
			$ret = mysqli_fetch_assoc($ret);
			if (!empty($ret['price']))
				$cmd_total += $ret['price'];
		}
		$request = 'INSERT INTO commands (`id`, `user_id`, `items`, `amount`, `date`) VALUES (NULL, '.$cmd_usr_id['id'].', "'.$_SESSION['cart'].'", '.$cmd_total.', NOW());';
		if (($ret = mysqli_query($sql_ptr, $request)) === false)
		{
			echo '<script>alert("Cannot checkout (mySQL error)");</script>';
			return ;			
		}	
		$_SESSION['cart'] = NULL;
		echo '<script>alert("Order confirmed.");</script>';
	}
	load_cart($cart, $sql_ptr);
?>
