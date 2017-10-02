<!doctype html>
<html>
<header>
  <title> Add Favorite to Database </title>
  <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
</header>

<body class=add_creditUser>
<h1> CREDDIT </h1>

<!--add story to database -->

<?php
require 'database_news.php';
session_start(); 

$story_id= $_GET['story_id'];
$user_id = $_SESSION['user_id']; 
$favorite = 1; 


/*Check to see i user_ID and story_ID already exist in favorites */
/*making it work*/ 
 /*$stmt = $mysqli->prepare("SELECT favorite FROM favorites where user_ID=$user_id and story_ID=$story_id");
  
  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }
  
  $stmt->execute();

  $stmt->bind_result($fav);
  
  while($stmt->fetch()){
    printf("\t<li> %s</li>\n",
      htmlspecialchars($newUser)
    );
  } 
  
  if($stmt != null){
    echo "You must really like this article. " ."<br>". "You've already favorited it!.";
		echo "<form name='back' action ='homePage_loggedin.php' name='back'> <button type='submit'> Back </button> </form>"; 
		exit; 
    
  }  */
 
/*add favorite to table*/ 
$stmt = $mysqli->prepare("insert into favorites (favorite, story_ID, user_ID) values (?,?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sss', $favorite, $story_id, $user_id);

$stmt->execute();

$stmt->close();
?>

<h4> You favorited the article! </h4>
<form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
    </p>
</form>

</body>
</html> 