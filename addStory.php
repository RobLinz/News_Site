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
    
$title = (string) $_POST['title'];
$link = (string) $_POST['link'];
$desc = (string) $_POST['description'];
$sect = (string) $_POST['sect'];
$user_id = $_SESSION['user_id']; 

if($sect == "world"){
    $sect = 'W';  
}
else if($sect == "poli"){
    $sect = 'P';  
}
else if($sect == "tech"){
    $sect = 'T';  
} 
else if($sect == "op"){
    $sect = 'O';  
}
else if($sect == "art"){
    $sect = 'A';  
}
else{
    $sect = 'E'; 
}

$stmt = $mysqli->prepare("insert into stories (title, story_description, story_link, user_ID, category) values (?,?,?,?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sssis', $title, $desc, $link, $user_id, $sect);

$stmt->execute();

$stmt->close();

 echo "You've added a new story! ";

?>
<form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
    </p>
</form>


