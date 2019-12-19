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
	
	include $_SERVER['DOCUMENT_ROOT']. '/teste_ijdb/includes/db.inc.php';
	
}

 //Build the list of authors
$sql="SELECT id, name FROM author";
$result=mysqli_query($link, $sql);
if (!$result)
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
$sql="SELECT id, name FROM author";
$result=mysqli_query($link, $sql);
if (!$result)
{
	$error='Error fetching list of categories.';
	include 'error.html.php';
	exit();
}

while ($row=mysqli_fetch_array($result))
{
	$categories[]=array('id'=>$row['id'], 'name'=>$row['name']), 'selected'=>FALSE);
}

  include 'form.html.php';
  exit();

}


if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "SELECT id, joketext, authorid FROM joke WHERE id='$id'";
	$result = mysqli_query($link, $sql);
	if (!$result)
  {
		$error = 'Error fetching joke details.';
		include 'error.html.php';
		exit();
   }
	$row = mysqli_fetch_array($result);
	$pagetitle = 'Edit Joke';
	$action = 'editform';
	$text = $row['joketext'];
	$authorid = $row['authorid'];
	$id = $row['id'];
	$button = 'Update joke';
	
	// Build the list of authors
	$sql = "SELECT id, name FROM author";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Error fetching list of authors.';
		include 'error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
	{
	$authors[] = array('id' => $row['id'], 'name' => $row['name']);
	}

	// Get list of categories containing this joke
	$sql = "SELECT categoryid FROM jokecategory WHERE jokeid='$id'";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Error fetching list of selected categories.';
		include 'error.html.php';
		exit();
	}
	while ($row = mysqli_fetch_array($result))
	{
		$selectedCategories[] = $row['categoryid'];
	}
	
	// Build the list of all categories
	$sql = "SELECT id, name FROM category";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Error fetching list of categories.';
		include 'error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
    {
		$categories[] = array(
		'id' => $row['id'],
		'name' => $row['name'],
		'selected' => in_array($row['id'], $selectedCategories));
	}
	include 'form.html.php';
	exit();
}
	
	if (isset($_GET['addform']))
{
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	$text = mysqli_real_escape_string($link, $_POST['text']);
	$author = mysqli_real_escape_string($link, $_POST['author']);
	
	if ($author == '')
	{
		$error = 'You must choose an author for this joke.
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
	
if (isset($_GET['editform']))
{
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	$text = mysqli_real_escape_string($link, $_POST['text']);
	$author = mysqli_real_escape_string($link, $_POST['author']);
	$id = mysqli_real_escape_string($link, $_POST['id']);
	if ($author == '')
	{
		$error = 'You must choose an author for this joke.
			Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}
	
	$sql = "UPDATE joke SET
		joketext='$text',
		authorid='$author'
		WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating submitted joke.';
		include 'error.html.php';
		exit();
	}
	
	$sql = "DELETE FROM jokecategory WHERE jokeid='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error removing obsolete joke category entries.';
		include 'error.html.php';
		exit();
	}

	if (isset($_POST['categories']))
	{
	foreach ($_POST['categories'] as $category)
		{
		$categoryid = mysqli_real_escape_string($link, $category);
		$sql = "INSERT INTO jokecategory SET
			jokeid='$id',
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

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$id = mysqli_real_escape_string($link, $_POST['id']);
	// Delete category assignments for this joke
	$sql = "DELETE FROM jokecategory WHERE jokeid='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error removing joke from categories.';
		include 'error.html.php';
		exit();
	}
	
	// Delete the joke
	$sql = "DELETE FROM joke WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting joke.';
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}
	
?>
