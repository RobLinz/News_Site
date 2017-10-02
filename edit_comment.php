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
    
    $_SESSION['comment_id'] = $_GET['val'];
                
    $stmt = $mysqli->prepare("SELECT info_users.username, comment, comment_ID, comments.user_ID FROM comments JOIN info_users on (comments.user_ID = info_users.user_ID) where comment_ID=?");
    $stmt -> bind_param('s', $_SESSION['comment_id']);
                        
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
    }
                        
    $stmt->execute();
                      
    $stmt->bind_result($username, $comment, $comment_ID, $user_ID);
    
    while($stmt->fetch()){ 
         echo htmlspecialchars($username);
         echo htmlspecialchars($comment);
         echo htmlspecialchars($comment_ID);
         echo htmlspecialchars($user_ID);
         /*echo "<a class='button' href='resubmit_comment.php?val=$comment_id'>   Resubmit Comment  </a></h4>";*/
    }
    $stmt->close(); 
?>
<!-- Print info of story in Story form -->
    <form name="input" action="resubmit_comment.php" name="login" method="post">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                    
                <!--Comment--> 
                <p class="comment">
                <label for="comment">Comment:</label>
                <textarea style = "resize:none" name="comment" id="comment" cols="60" rows="3"><?php echo $comment;?></textarea>
                <br> <br> </p>
                
            <p>Please, please, PLEASE don't say anything mean. The internet is not the place. <br> Go find a puppy and be mean to that if you're so cruel.</p>
            <button type="submit">Submit Comment</button>
    </form>


<!--resubmit form as new with alter to older story OR delete old story--> 

<form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
    </p>
</form>

</body>
</html> 