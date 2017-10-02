<!doctype html>
<html>
<header>
  <title> Creating New User </title>
  <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
</header>

<body class=add_creditUser>
<h1> CREDDIT </h1>

<!--Delete story from database --> 
<?php
require 'database_news.php';
session_start(); 
    
$_SESSION['comment_id'] = $_GET['val'];
/*var_dump($_SESSION['story_id']);*/ 

$stmt = $mysqli->prepare("delete from comments where comment_ID =?");
$stmt -> bind_param('i', $_SESSION['comment_id']);

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->close();

?>
<h4> Your comment has been deleted.</h4>
<form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
    </p>
</form>
