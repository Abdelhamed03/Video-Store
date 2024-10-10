<!DOCTYPE html>
<html>
<head><title>Search for a Movie</title></head>
    
<body>
<h1>Search for a Movie</h1>
    
<?php
    session_start();
    if (isset($_SESSION["uname"]) && $_SESSION["uname"]!="")
    {   
        echo $_SESSION["fullname"];
        echo "<br><br><br>";
  
?>
    
<form action="welcome.php" method="POST">
    Title: <input type="text" name="title">
    <br><br>
    Author: <input type="text" name="author">
    <br><br>
    Publisher: <input type="text" name="publisher">
    <br><br>
    Genre: <input type="text" name="genre">
    <br><br>
    <br><br>
    <input type="reset" value="Clear">
    <input type = "submit" value="Search">
</form>
    
<?php
      }
    else
    {
        echo "You are not supposed to be here!<br>";
        echo "<a href=\"index.html\">Login</a> to continue.";
    }
?>
    
</body>
</html>