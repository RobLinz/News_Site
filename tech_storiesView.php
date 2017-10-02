<!-- Display all stories in technology  -->
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
             <h3 class=sign-in> Sign-In Here:</h3>
             <form name="input" action="homePage_user.php" name="login" method="post">
                <p>
                <label for="username">Username:</label>
                <input type="text" name="user" id="user"/>
                <label for="password">Password:</label>
                <input type="password" name="pass" id="pass"/> <br>
                <button type="submit">Login</button>
                </p>
             </form> 
            <h5> No account? No problem! Register <a href="newCredit_user.php"> here</a>.</h5>
            
            <h3 class=sect> Sections: </h3>
            <ul>
                <li> <a href="homePage.php"> Home </a></li>
                <li> <a href="worldNews_storiesView.php">World News</a></li>
                <li> <a href="politics_storiesView.php"> Politics </a></li>
                <li> <a href="tech_storiesView.php">Technology </a></li>
                <li> <a href="opinion_storiesView.php">Opinion </a></li>
                <li> <a href="art_storiesView.php">Art</a></li>
                <li> <a href="other_storiesView.php">Other</a></li>
            </ul>
        </div>
        
        <div id=news>
            <h2 class=ourStory>Technology: </h2>
            <!--here we will display stories -->
            <?php
                require 'database_news.php';
                session_start(); 
                          
                $stmt = $mysqli->prepare("SELECT story_ID, title, story_description, story_link, category FROM stories where category='T'");
                        
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                        
                $stmt->execute();
                      
                $stmt->bind_result($story_id, $title, $description, $link, $category); 
                
                while($stmt->fetch()){ 
                  echo "<h2> <a href=".htmlspecialchars($link).">".htmlspecialchars($title)."</a> </h3>";
                    /* Button needed for commenting on a story */
                    echo "<h4> ".htmlspecialchars($description)."<a class='button' href='story_comments.php?val=$story_id'> Comments </a></h4>";
                }
                $stmt->close(); 
                
            ?> 
        </div>
        
    </body>
    
</html>