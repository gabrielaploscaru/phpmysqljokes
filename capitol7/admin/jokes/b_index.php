<?php

include_once $_SERVER['DOCUMENT_ROOT']. '/teste_ijdb/includes/magicquotes.inc.php';

if (isset($_GET['add']))
{
	$pagetitle='New Joke';
	$action='addform';
	$text='';
	$authorid='';
	$id='';
	$button='Add joke';
	
	include_once $_SERVER['DOCUMENT_ROOT']. '/teste_ijdb/includes/db.inc.php';


	//Build the  list of authors
	$sql="SELECT id, name FROM author";
	$result=mysqli_query($link, $sql);
	if(!$result)
	{
		$error='Error fetching list of authors.';
		include 'error.html.php';
		exit();
	}

		
	while ($row=mysqli_fetch_array($result))
	{
		$authors[]=array('id'=>$row['id'], 'name'=>$row['name']);
	}

	//Build the list of categories
		
	$result=mysqli_query($link, 'SELECT id, name FROM category');
	if (!$result)
	{
		$error='Error fetching categories from database';
		include 'error.html.php';
		exit();
	}

	while ($row=mysqli_fetch_array($result))
	{
		$categories[]=array('id'=>$row['id'], 'name'=>$row['name'], 'selected'=>FALSE);
	}

	include 'form.html.php';
	exit();
}


if (isset($_GET['addform']))
{
	include $_SERVER['DOCUMENT_ROOT']. '/teste_ijdb/includes/db.inc.php';
	$text=mysqli_real_escape_string($link, $_POST['text']);
	$author=mysqli_real_escape_string($link, $_POST['author']);

	if ($author =='')
	{
		$error='You must choose an author for this joke.
		     Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
		
	}
	
	$sql = "INSERT INTO joke SET
		joketext='$text',
		jokedate=CURDATE(),
		authorid='$author'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error adding submitted joke.';
		include 'error.html.php';
		exit();
	}
	$jokeid = mysqli_insert_id($link);

	
	
if (isset($_POST['categories']))
	{
        foreach ($_POST['categories'] as $category)
     {
		$categoryid = mysqli_real_escape_string($link, $category);
		$sql = "INSERT INTO jokecategory SET
          jokeid='$jokeid',
          categoryid='$categoryid'";
     if (!mysqli_query($link, $sql))
      {
		$error = 'Error inserting joke into selected category.';
		include 'error.html.php';
		exit();
		}
	}
}

	header('Location: .');
	exit();
		
}


-----------236








if (isset($_POST['action']) and $_POST['action']=='Edit')
{
	include $_SERVER['DOCUMENT_ROOT'] . '/teste_ijdb'/includes/db.inc.php';
	
	$id=mysqli_real_escape_string($link, $_POST['id']);
	$sql="SELECT  id, joketext, authorid FROM joke WHERE id='$id'";
	$result=mysqli_query($link, $sql);
	
	if(!$result)
	{
		$error='Error fetching joke details.';
		include 'error.html.php';
		exit ();
	}	
	$row=mysqli_fetch_array($result);
	
	$pagetitle='Edit Joke';
	$action='editform';
	$text=$row['joketext'];
	$authorid=$row['authorid'];
	$id=$row['id'];
	$button='Update joke';
	
	
	//Build the  list of authors
	$sql="SELECT id, name FROM author";
	$result=mysqli_query($link, $sql);
	if(!$result)
	{
		$error='Error fetching list of authors.';
		include 'error.html.php';
		exit();
	}

	while ($row=mysqli_fetch_array($result))
	{
		$authors[]=array('id'=>$row['id'], 'name'=>$row['name']);
	}
	
	//Get list of categories containing this joke
	$sql="SELECT categoyid FROM jokecategory WHERE jokeid='$id'";
	$result=mysqli_query($link, $sql);
	if (!$result)
	{
		$error='Error fetching list of selected categories.';
		include 'error.html.php'
		exit();
	}
	
	while ($row=mysqli_fetch_array($result)
	{
		$selectCategories[]=$row['categoryid'];
	}
	
	// Build the list of all categories
		$sql="SELECT id, name FROM category";
		$result=mysqli_query($link, $sql);
		if(!$result)
		{
		$error='Error fetching list of categories.';
		include 'error.html.php'
		exit();
		}
	
	while ($row=mysqli_fetch_array($result))
	$categories[]=array('id'=>$row['id'], 'name'=>$row['name'], 'selected'=>in_array($row['id'],SelectedCategoires));
 }
  include 'form.html.php';
  exit();
		
}




if (isset($_GET['action']) and $_GET['action']=='search')
{
	include $_SERVER['DOCUMENT_ROOT'] . '/teste_ijdb/includes/db.inc.php';
	
	echo "text:".$_GET['text']."<br/>"; 
	echo "author:".$_GET['author']."<br/>";
	echo "category:".$_GET['category'];
	
	
	// The basic SELECT statement
	$select='SELECT id, joketext';
	$from='FROM joke';
	$where='WHERE TRUE';
	
		
	
	$authorid=mysqli_real_escape_string($link, $_GET['author']);
	if ($authorid !='') // An author is selected
	{
		$where.=" And authorid='$authorid'";
	}
	
	echo "---";
	echo "where:".$where;
	
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
	
	$authorid=mysqli_real_escape_string($link, $_GET['author']);
	
	if ($authorid!='') // An author is selected
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
		$where .= " AND joketext LIKE '%$text%'";
	}
	
	echo $select . $from . $where;

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
}


include 'searchform.html.php';

include 'jokes.html.php';

?>