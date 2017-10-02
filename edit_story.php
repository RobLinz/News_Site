<!doctype html>
<html>
<header>
  <title> Creating New User </title>
  <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
</header>

<body class=add_creditUser>
<h1> CREDDIT </h1>

<!--Get Info about Story -->
<?php
    require 'database_news.php';
    session_start();
    
    $_SESSION['story_id'] = $_GET['val'];
                
    $stmt = $mysqli->prepare("SELECT story_ID, title, story_description, story_link, user_ID FROM stories where story_ID=?");
    $stmt -> bind_param('i', $_SESSION['story_id']);
                        
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
    }
                        
    $stmt->execute();
                      
    $stmt->bind_result($story_id, $title, $description, $link, $user_id);
    
    while($stmt->fetch()){ 
         /*echo htmlspecialchars($story_id);
         echo htmlspecialchars($title);
         echo htmlspecialchars($description);
         echo htmlspecialchars($link);
         echo htmlspecialchars($user_id); 
         echo "<a class='button' href='resubmit_story.php?val=$story_id'>   Resubmit Story  </a></h4>";*/
    }
    $stmt->close(); 
?>
<!-- Print info of story in Story form -->
    <form name="input" action="resubmit_story.php" name="login" method="post">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" /> 
                
                <!--title-->  
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?php echo $title;?>" /> <br>
                <br>
                <!--link-->
                <label for="link">Link:</label>
                <input type="text" name="link" id="link" value="<?php echo $link;?>" /> <br>
                <br>
                
                <!--description--> 
                <p class="description">
                <label for="description">Description:</label>
                <textarea style = "resize:none" name="description" id="description" cols="60" rows="3"  ><?php echo $description;?></textarea>
                <br> <br> </p>
                
                <!--section-->
                <p class=sect>
                <strong> <label for="sect">Section:</label> <br> </strong>
                <input type= "radio" name="sect" value="world" id="world" required> World <br>
                <input type= "radio" name="sect" value="poli" id="poli"> Politics <br>   
                <input type= "radio" name="sect" value="tech" id="tech"> Technology <br>
                <input type= "radio" name="sect" value="op" id="op"> Opinion <br> 
                <input type= "radio" name="sect" value="art" id="art"> Art <br> 
                <input type= "radio" name="sect" value="else" id="else"> Other <br
                </p> 
            
            <!-- echo "<a class='button' href='resubmit_story.php?val=$story_id'>   Resubmit Story  </a></h4>"; -->
            <button type="submit">Resubmit Story</button>
    </form> 


<!--resubmit form as new with alter to older story OR delete old story--> 

<form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
    </p>
</form>

</body>
</html> 
