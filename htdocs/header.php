
<?php
function load_index_php()
{
	header("location: /");
}

$sql_ptr = mysqli_connect("localhost:3306", "root", "qwerty", "rush00");
if (!$sql_ptr)
	exit("mySQL error: ".mysqli_connect_error().PHP_EOL);
?>
<div class="top-box">
	<h1 class="site-title">
		<a href="/">
			ft_minisexshop
		</a>
	</h1>
	<table>
		<tr>
			<th><a href="/categories?cat=1">Condoms</a></th>
			<th><a href="/categories?cat=2">Cockrings</a></th>
			<th><a href="/categories?cat=3">Dildos</a></th>
			<th><a href="/categories?cat=4">Lingeries</a></th>
			<th><a href="/categories?cat=5">Lubes</a></th>
		</tr>
	</table>
</div>
