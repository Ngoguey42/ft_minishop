<?php
$ret = mysqli_connect("localhost:3306", "root", "qwerty");
if (!$ret)
	exit("Could not connect: ".mysqli_error($ret).PHP_EOL);
echo "Connected successfully".PHP_EOL;
mysqli_close($ret);
?>
