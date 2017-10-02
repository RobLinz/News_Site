<!DOCTYPE html>
<html>
  <header>
    <title> New User Page </title>
    <link rel="stylesheet" type="text/css" href="homePage_styleSheet.css">
  </header>
  
<body class=newCredit_user>

<h1> CREDDIT </h1>
<h3 class=pleaseFill>Please fill out the form below</h3>

<form action="add_creditUser.php" method="POST">
  <label for="username">Username: </label>
  <input type="text" name="user" id="user"/>
  <br>
  <label for="password"> Password: </label>
  <input type="password" name="pass" id="pass"/>
  <button type="submit">Login</submit>
</form>


</body>
</html>
