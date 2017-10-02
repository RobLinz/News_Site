<!doctype html>
<html>
<header>
  <title> Creating New User </title>
  <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
</header>

<body class=add_creditUser>
<h1> CREDDIT </h1>

<!--add story to database --> 
<?php
require 'database_news.php';
session_start(); 

$comment = (string) $_POST['comment'];
$comment_id = $_SESSION['comment_id'];
$story_id = $_SESSION['story_id']; 
$user_id = $_SESSION['user_id'];


$stmt = $mysqli->prepare("update comments set story_ID=?, comment=?, user_ID=? where comments.comment_ID=$comment_id");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('isi', $story_id, $comment, $user_id);

$stmt->execute();

$stmt->close();

?>
<h3> Your comment has been resubmitted.</h3>
<form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
    </p>
</form>
