<?php
$link = mysqli_connect('localhost', 'root', '');
if (!$link)
{
	$error = 'Unable to connect tothe database server.';
	include 'error.html.php';
	exit();
}

if (!mysqli_set_charset ($link, 'utf8'))
{
	$output='Unable to set database connection encoding.';
	include 'output.html.php';
	exit();
}

if (!mysqli_select_db($link, 'ijdb'))
{
	$error = 'Unable to locate the joke database.';
	include 'error.html.php';
	exit();
}
?>