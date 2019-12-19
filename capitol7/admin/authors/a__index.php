if (isset($_POST['action']) and $_POST['action']=='Delete')
{
	include $_SERVER['DOCUMENT_ROOT']. '/teste_ijdb/includes/db.inc.php';
	$id = mysqli_real_escape_string($link, $_POST['id']);
	
//Get jokes belonging to author
$sql = "SELECT id FROM joke WHERE authorid='$id'";
$result = mysqli_query($link, $sql);
if (!$result)
{
$error = 'Error getting list of jokes to delete.';
include 'error.html.php';
exit();
}

// For each joke
while ($row = mysqli_fetch_array($result))
{
 $jokeId = $row[0];

	// Delete joke category entries
	$sql = "DELETE FROM jokecategory WHERE jokeid='$jokeid'";
	if (!mysqli_query($link, $sql))
	{
    $error = 'Error deleting category entries for joke.';
     include 'error.html.php';
     exit();
  }
}

// Delete jokes belonging to author
$sql = "DELETE FROM joke WHERE authorid='$id'";
if (!mysqli_query($link, $sql))
{
$error = 'Error deleting jokes for author.';
include 'error.html.php';
exit();
}

// Delete the author
$sql = "DELETE FROM author WHERE id='$id'";
if (!mysqli_query($link, $sql))
{
	$error = 'Error deleting author.';
include 'error.html.php';
exit();
}

header('Location: .');
exit();
}

/*$result=mysqli_query($link, 'SELECT id, name FROM author');
if (!$result)
{
	$error='Error fetching authors from database!';
	include 'error.html.php';
	exit();
}	


