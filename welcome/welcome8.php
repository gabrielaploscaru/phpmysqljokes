<?php
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST ['lastname'];
if ($firstname == 'Kevin' and $lastname=='Yank')
{
	echo 'Welcome, oh glorious leader!';
}
else
{
	echo 'Welcome to our web site,' . ' ' .
	 htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') . ' '.
	 htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') . '!';
}
?>