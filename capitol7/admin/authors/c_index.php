<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/teste_ijdb/includes/db.inc.php';
$result = mysqli_query($link, 'SELECT id, name FROM author');
if (!$result)
{
	$error = 'Error fetching authors from database!';
	include 'error.html.php';
	exit();
}
while ($row = mysqli_fetch_array($result))
{
	$authors[] = array('id' => $row['id'], 'name' => $row['name']);
}
include 'authors.html.php';
?>