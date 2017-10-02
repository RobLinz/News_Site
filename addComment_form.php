<!doctype html>                  
 <html>               
    <head>
        <title> Add Comment Form </title>
        <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
    </head>
    
    <body>
        <h1> CREDDIT </h1>
        <?php
            session_start();
            
            $_SESSION['story_ID'] = $_GET['story_id'];
             var_dump($_SESSION['story_ID']);
        ?>
        
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
      <label> Warning! This will cancel your submission.</label>
    </p>
    </form>
    </body>
</html>    