<?php
//Display search form
include $_SERVER['DOCUMENT_ROOT']. '/teste_ijdb/includes/db.inc.php';

$result=mysqli_query($link,'SELECT id, name FROM author');
if(!$result)
{
	$error='Error fetching authors from database!';
	include 'error.html.php';
	exit();
}
while ($row=mysqli_fetch_array($result))
{
	$authors[]=array('id'=>$row['id'], 'name'=>$row['name']);
}


$result=mysqli_query($link, 'SELECT id, name FROM category');
if (!$result)
{
	$error='Error fetching categories from database';
	include 'error.html.php';
	exit();
}
while ($row=mysqli_fetch_array($result))
{
	$categories[]=array('id'=>$row['id'], 'name'=>$row['name']);
}


include 'searchform.html.php';

if (isset($_GET['action']) and $_GET['action']=='search')
{
	include $_SERVER['DOCUMENT_ROOT'] . '/teste_ijdb/includes/db.inc.php';
	
	
	// The basic SELECT statement
	$select='SELECT id, joketext';
	$from=' FROM joke';
	$where=' WHERE TRUE';
	
		
	
	$authorid=mysqli_real_escape_string($link, $_GET['author']);
	if ($authorid !='') // An author is selected
	{
		$where.=" And authorid='$authorid'";
	}
	
	
	$categoryid = mysqli_real_escape_string($link,$_GET['category']);
	if ($categoryid != '') // A category is selected
	{
		$from .= ' INNER JOIN jokecategory ON id = jokeid';
		$where .= " AND categoryid='$categoryid'";
	}
	
	$text = mysqli_real_escape_string($link, $_GET['text']);
	if ($text != '') // Some search text was specified
	{
		$where .=  $authorid=mysqli_real_escape_string($link, $_GET['author']);
	}
	if ($authorid!='') // An author is selected
	{
		$where.=" And authorid='$authorid'";
	}
	
	$text = mysqli_real_escape_string($link, $_GET['text']);
	if ($text != '') // Some search text was specified
	{
		$where .= " AND joketext LIKE '%$text%'";
	}
	
	
	$result = mysqli_query($link, $select . $from . $where);
	if (!$result)
	{
		$error = 'Error fetching jokes.';
		include 'error.html.php';
		exit();
	}
	

	while ($row = mysqli_fetch_array($result))
	{
		$jokes[] = array('id' => $row['id'], 'text' => $row['joketext']);
		
	}
	//print_r($jokes);
	include 'jokes.html.php';
}

?>