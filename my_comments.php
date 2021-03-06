<!-- Display all comments by user that is currently logged in -->
<!doctype html>
<html>
    
    <head>
        <title> Home Page </title>
        <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
    </head>
    
    <body class=homePage>
    
        <div id="top">
        <h4 class=intro1> We present to you... </h4>
        <h1> CREDDIT </h1>
        <h4 class=intro2> A low key, unassuming, reddit. For some credit. </h4>
        </div>
        
    
        <div id=sidebar>
            <h4 class=loggedIn> Welcome to your Creddit Community!</h4>
            <h3 class=sect> Sections: </h3>
            <ul>
                <li> <a href="homePage_loggedin.php"> Home </a></li>
                <li> <a href="worldNews_stories.php">World News</a></li>
                <li> <a href="politics_stories.php"> Politics </a></li>
                <li> <a href="tech_stories.php">Technology </a></li>
                <li> <a href="opinion_stories.php">Opinion </a></li>
                <li> <a href="art_stories.php">Art</a></li>
                <li> <a href="other_stories.php">Other</a></li>
                <li> <a href="my_favorites.php"> My Favorite Articles</a></li>
                <li> <a href="my_comments.php"> My Comments</a></li>
                <li> <a href="my_stories.php"> My Stories</a></li>
            </ul>
            
            <form name="submit" action="addStory_form.php" name="login" method="post">
                <p>
                <button type="submit">Add Story</button>
                </p>
            </form>
            <form name="logout" action="homePage.php" name="logout" method="post">
                <p>
                <button type="submit">Logout</button>
                </p>
            </form> 
        </div>
        
        <div id=news>
            <h2 class=ourStory>My Comments: </h2>
            <!--here we will display stories -->
            <?php
                require 'database_news.php';
                session_start(); 
                          
                $stmt = $mysqli->prepare("SELECT stories.title, comments.story_ID, comment_ID, comment, comments.user_ID FROM comments JOIN stories on (comments.story_ID = stories.story_ID) where comments.user_ID=?");
                $stmt -> bind_param('s', $_SESSION['user_id']);
                        
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                        
                $stmt->execute();
                      
                $stmt->bind_result($title, $story_id, $comment_id, $comment, $user_id);
                
                while($stmt->fetch()){ 
                    /* Button needed for commenting on a story */
                    echo "<h4> Article: ".htmlspecialchars($title)." </h4> <h5>  Comment: ".htmlspecialchars($comment)."</h5>";
                    echo "<input type='hidden' name='token' value=".htmlspecialchars($_SESSION['token'])." /> ";
                    echo "<a class='button' href='delete_comment.php?val=$comment_id'>  Delete  </a></h4><br> ";
                    echo "<a class='button' href='edit_comment.php?val=$comment_id'>   Edit  </a></h4>";
                    /*echo "<form name='delete' action='delete_story.php' name='delete' method='post'> <button type='submit'>Delete</button> </form> <form name='edit' action='edit_story.php' name='edit' method='post'> <button type='submit'>Edit</button> </form>"; */
                }
                $stmt->close(); 
                
            ?> 
        </div>
        
    </body>
    
</html>