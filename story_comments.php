<!doctype html>
<html>
<header>
  <title> Story Page with Comments </title>
  <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
</header>

<body class=add_creditUser>
<h1> CREDDIT </h1>

<?php
        require 'database_news.php';
        session_start();

        $_SESSION['story_id'] = $_GET['val'];
        /*var_dump($_SESSION['story_id']);*/ 

        $stmt = $mysqli->prepare("SELECT info_users.username, title, story_description, story_link, stories.user_ID FROM stories JOIN info_users on (stories.user_ID = info_users.user_ID) where story_ID ='$_SESSION[story_id]'");
                        
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            
            $stmt->execute();
                      
            $stmt->bind_result($username, $title, $description, $link, $user_ID);
                
            while($stmt->fetch()){
                echo "<h2> <a href=".htmlspecialchars($link).">".htmlspecialchars($title)."</a> </h2>";
                echo "<h4> ".htmlspecialchars($description)." </h4> <p> By: ".htmlspecialchars($username)."</p> <br> <br>"; 
              
            }
            $stmt->close();
            
            /*Comment printing*/
            $stmt = $mysqli->prepare("SELECT info_users.username, comment, comment_ID, comments.user_ID FROM comments JOIN info_users on (comments.user_ID = info_users.user_ID) where story_ID=?");
            $stmt -> bind_param('s', $_SESSION['story_id']);
                        
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                        
                $stmt->execute();
                      
                $stmt->bind_result($username, $comment, $comment_ID, $user_ID);
                
                while($stmt->fetch()){
                    echo "<p> ".htmlspecialchars($username).": ".htmlspecialchars($comment)."</p>";
                }
                $stmt->close(); 
?>
    <br><br><br><br><br><br><br><br><br>
    <h4> Leave a comment here: </h4>
    <form name="input" action="addComment.php" name="login" method="post">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                    
                <!--Comment--> 
                <p class="comment">
                <label for="comment">Comment:</label>
                <textarea style = "resize:none" name="comment" id="comment" cols="60" rows="3"></textarea>
                <br> <br> </p>
                
            <p>Please, please, PLEASE don't say anything mean. The internet is not the place. <br> Go find a puppy and be mean to that if you're so cruel.</p>
            <button type="submit">Submit Comment</button>
    </form>
        
    <form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
    </p>
    </form>
</body>
</html>

