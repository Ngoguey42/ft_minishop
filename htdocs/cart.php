<?php
	$cart;
	function load_cart(&$cart, $sql_ptr)
	{
		if (empty($_SESSION['cart']))
			$_SESSION['cart'] = serialize(array());
		$cart = unserialize($_SESSION['cart']);
	}
	function print_cart($sql_ptr)
	{
		var_dump($_SESSION['cart']);
	}
	function add_to_cart(&$cart)
	{
		$cart[] = $_GET['id'];
		$_SESSION['cart'] = serialize($cart);
		echo '<script>alert("Added to cart.");</script>';
	}
	function clear_cart()
	{
		$_SESSION['cart'] = serialize(array());
		echo '<script>alert("The cart has been cleared.");</script>';
	}
	load_cart($cart, $sql_ptr);
?>
