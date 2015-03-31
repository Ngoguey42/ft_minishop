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
		/* 		echo '<script>alert("Added to cart.");</script>'; */
		save_action_and_reload("Added to cart");
	}
	function clear_cart()
	{
		$_SESSION['cart'] = NULL;
		save_action_and_reload("The cart has been cleared");
		/* 		echo '<script>alert("The cart has been cleared.");</script>'; */
	}
	function checkout_cart($sql_ptr)
	{
		var_dump($_SESSION['cart']);
		if (empty($_SESSION['cart']))
			save_action_and_reload("Nothing to checkout");
		if (empty($_SESSION['login']))
			save_action_and_reload("You must be connected to checkout");
			if (($cmd_usr_id = mysqli_query($sql_ptr, 'SELECT id FROM users WHERE login="'.$_SESSION['login'].'";')) === false)
			save_action_and_reload("Cannot checkout (mySQL error)");
		$cmd_usr_id = mysqli_fetch_assoc($cmd_usr_id);
		$cmd_total = 0;
		$unserlz_cart = explode(";", $_SESSION['cart']);
		foreach ($unserlz_cart as $k)
		{
			if (($ret = mysqli_query($sql_ptr, 'SELECT price FROM items WHERE id="'.$k.'";')) === false)
				save_action_and_reload("Cannot checkout (mySQL error)");
			$ret = mysqli_fetch_assoc($ret);
			if (!empty($ret['price']))
				$cmd_total += $ret['price'];
		}
		$request = 'INSERT INTO commands (`id`, `user_id`, `items`, `amount`, `date`) VALUES (NULL, '.$cmd_usr_id['id'].', "'.$_SESSION['cart'].'", '.$cmd_total.', NOW());';
		if (($ret = mysqli_query($sql_ptr, $request)) === false)
			save_action_and_reload("Cannot checkout (mySQL error)");
		$_SESSION['cart'] = NULL;
		save_action_and_reload("Order confirmed");
		/* 		echo '<script>alert("Order confirmed.");</script>'; */
	}
	load_cart($cart, $sql_ptr);
?>
