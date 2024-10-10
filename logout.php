<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
    
        table, th, td, tr {
            border: solid black;
            border-collapse: collapse
        }
        
    </style>
</head>
<body>
    
<?php
     session_start();
     if(isset($_SESSION["uname"]) && $_SESSION["uname"]!="")
        {
            echo $_SESSION["fullname"];
            echo " logged out successfully.";
            session_destroy();
            echo "Back to login <a href=\"index.html\"> here </a>";
     }
            
?>
</body>
</html>