<!doctype html>
<html>
<header>
  <title> Creating New User </title>
  <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
</header>

<body class=add_creditUser>
<h1> CREDDIT </h1>
<?php
  require 'database_news.php';
  $newUser= (string) $_POST['user'];
  $usernameNew = $newUser;
  $pwd= (string) $_POST['pass'];
    
  //check info_users to see that username doesn't already exist
  $stmt = $mysqli->prepare("SELECT username FROM info_users WHERE username = '$newUser'");
  
  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }
  
  $stmt->execute();

  $stmt->bind_result($newUser);
  
  while($stmt->fetch()){
    /*printf("\t<li> %s</li>\n",
      htmlspecialchars($newUser)
    );*/
  }
  
  if($newUser != null){
    echo "Sorry! That user name is taken. " ."<br>". "Give it another go.";
    
  } else{
      
    /*Make a new user*/
    
    /*hash password:*/
    $pwd_Hash = password_hash($pwd, PASSWORD_BCRYPT);
    
    /*Make a new user*/
    $stmt = $mysqli->prepare("insert into info_users (username, password_hash) values ( ?, ?)");
    if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
    }
  
    /*Number of variables doesn't match number of parameters in prepared statement in /home/roboRobi/public_html/add_creditUser.php on line 27*/
    $stmt->bind_param('ss', $usernameNew, $pwd_Hash);
  
    $stmt->execute();
  
    $stmt->close();
      /*congratulate the people on what they've done. Welcome them to the Creddit community.*/
    echo "You've made a new account! " . "Welcome " . $usernameNew . " to our Creddit Community!";
  }


  ?>
   <form name="retry" action="newCredit_user.php" name="retry">
    <p>
      <button type="submit">Back</button>
    </p>
  </form>
  <form name="back" action="logout_user.php" name="Go back">
    <p>
      <button type="submit">Home</button>
    </p>
  </form>
</body>
</html>