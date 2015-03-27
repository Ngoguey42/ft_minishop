<?php
	function load_cart($sql_ptr)
	{
		if (empty($_SESSION['cart']))
			$_SESSION['cart'] = serialize(array());
		$cart = unserialize($_SESSION['cart']);
	}
	function print_cart($sql_ptr)
	{
		var_dump($_SESSION['cart']);
	}
	// function add_to_cart($sql_ptr, $id)
	// {

	// }
	function clear_cart()
	{
		$_SESSION['cart'] = serialize(array());
		echo '<script>alert("The cart has been cleared.");</script>';
	}
	load_cart($sql_ptr);
?>
