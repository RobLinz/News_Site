<!DOCTYPE html>
<html> 
 <head>
  <title> User's Home Page </title>
  <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
 </head>
<body>

<?php
    require 'database_news.php';
    
    //check if the username and password are in the database
    $pwd_guess = (string) $_POST['pass'];
    $pwd_hash = password_hash($pwd_guess, PASSWORD_BCRYPT);
    
    
   //password-based user authentication 
   $stmt = $mysqli->prepare("SELECT COUNT(*), user_ID, password_hash FROM info_users WHERE username=?");
   
   // Bind the parameter
   $stmt->bind_param('s', $user);
   $user = (string) $_POST['user'];
   $stmt->execute();
   
   // Bind the results
   $stmt->bind_result($cnt, $user_id, $pwd_hash);
   $stmt->fetch();
   
   // Compare the submitted password to the actual password hash
   
   if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
       // Login succeeded!
       
       session_start();
       $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
       $_SESSION['user_id'] = $user_id;
       
       
       //echo '<div class="feedback">Login success <br />redirecting...</div>';
       header("Location: http://ec2-18-221-53-132.us-east-2.compute.amazonaws.com/~roboRobi/homePage_loggedin.php?");
       die();
       
   } else{
        // Login failed; redirect back to the login screen (opportunity to fill out form again below)
   }
?>
    
 <div id="top">
        <h4 class=intro1> We present to you... </h4>
        <h1> CREDDIT </h1>
        <h4 class=intro2> A low key, unassuming, reddit. For some credit. </h4>
        </div>
        
        <div id=sidebar>
            <h3 class=sign-in> Sign-In Here:</h3>
             <form name="input" action="homePage_user.php" name="login" method="post">
                <p>
                <label for="username">Username:</label>
                <input type="text" name="user" id="user"/>
                <label for="password">Password:</label>
                <input type="password" name="pass" id="pass"/> <br>
                <button type="submit">Login</button>
                </p>
            <h5> Wrong username or password.</h5>
            <h5> No account? No problem! Register <a href="newCredit_user.php"> here</a>.</h5>
            
            <h3 class=sect> Sections: </h3>
            <ul>
                <li> <a href="worldNews_stories.php">World News</a></li>
                <li> <a href="politics_stories.php"> Politics </a></li>
                <li> <a href="tech_stories.php">Technology </a></li>
                <li> <a href="opinion_stories.php">Opinion </a></li>
                <li> <a href="art_stories.php">Art</a></li>
            </ul>
        </div>
        
        <div id=news>
            <h2 class=ourStory>Our Stories: </h2>
            <?php
                require 'database_news.php';
                          
                $stmt = $mysqli->prepare("SELECT title, story_description, story_link FROM stories");
                        
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                        
                $stmt->execute();
                      
                $stmt->bind_result($title, $description, $link);
                echo $title;
                echo $description;
                echo $link; 
                while($stmt->fetch()){ 
                    echo "<h2> <a href=".htmlspecialchars($link).">".htmlspecialchars($title)."</a> </h3>";
                    echo "<h4> ".htmlspecialchars($description)."</h4>";
                }
                $stmt->close(); 
                
            ?> 
        </div>

</body>
</html>