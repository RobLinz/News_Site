<!doctype html>                  
 <html>               
    <head>
        <title> Add Story Form </title>
        <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
    </head>
    
    <body>
        <h1> CREDDIT </h1>
        <form name="input" action="addStory.php" name="login" method="post">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" /> 
                
                <!--title-->  
                <label for="title">Title:</label>
                <input type="text" name="title" id="title"/> <br>
                <br>
                <!--link-->
                <label for="link">Link:</label>
                <input type="text" name="link" id="link"/> <br>
                <br>
                
                <!--description--> 
                <p class="description">
                <label for="description">Description:</label>
                <textarea style = "resize:none" name="description" id="description" cols="60" rows="3"></textarea>
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
        
            <button type="submit">Submit Story</button>
        </form> 
    <form name="back" action="homePage_loggedin.php" name="back">
    <p>
      <button type="submit">Home</button>
      <label> Warning! This will cancel your submission.</label>
    </p>
    </form>
    </body>
</html>    