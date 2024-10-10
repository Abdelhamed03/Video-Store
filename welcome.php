<!DOCTYPE html>
<html>
<head><title>Welcome to Videostore Rentals</title></head>
    
<body>
    
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "videostore";
        
    // Create connection
    $conn = new mysqli($servername,$username,$password,$dbname);
    if ($conn -> connect_error)
    {
        die("Connection failed: " . $conn -> connect_error);
    }
    session_start();
    if(isset($_SESSION["uname"]) && $_SESSION["uname"]!="")
        {
        $sql = "SELECT fname, lname, userid, is_admin from user ";
        $sql = $sql . "where userid = '" . $_SESSION["uname"] . "'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            echo "<h1>Videostore Home Screen</h1>";
            echo "<h2>Welcome, " . $row["fname"] . " " . $row["lname"] . ".</h2>";
            echo "<h3>User Menu</h3>";
            echo "<ul>";
            echo "<li> <a href=\"searchFancy.php\"> Search for a Movie </a></li>";
            echo "<li> <a href=\"rentplayer.php\"> Rent a Player </a></li>";
            echo "<li> <a href=\"checkedout.php\"> View items checked out </a></li>";
            echo "<li> <a href=\"reserved.php\"> View items reserved </a></li>";
            echo "<li> <a href=\"viewfines.php\"> View outstanding with fines </a></li>";
            echo "</ul>";
            echo "<br><br>";

            if($row["is_admin"]==1)
            { 
                echo "<h3>Admin Menu</h3>";
                echo "<ul>";
                echo "<li> <a href=\"addmovie.php\"> Add a Movie </a></li>";
                echo "<li> <a href=\"addplayer.php\"> Add a Player </a></li>";
                echo "<li> <a href=\"adduser.php\"> Add a user </a></li>";
                echo "<li> <a href=\"adminsearch.php\"> Status of Movies </a></li>";
                echo "<li> <a href=\"stats.php\"> View interesting statistics </a></li>";
                echo "</ul>";
            }
        }
    }
    else
    {
        $userid = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "SELECT fname, lname, userid, password, is_admin from user ";
        $sql = $sql . "where userid = '" . $userid . "' and password= '". $password . "'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            echo "<h1>Videostore Home Screen</h1>";
            echo "<h2>Welcome, " . $row["fname"] . " " . $row["lname"] . ".</h2>";
            echo "<h3>User Menu</h3>";
            echo "<ul>";
            echo "<li> <a href=\"searchFancy.php\"> Search for a Movie </a></li>";
            echo "<li> <a href=\"rentplayer.php\"> Rent a Player </a></li>";
            echo "<li> <a href=\"checkedout.php\"> View items checked out </a></li>";
            echo "<li> <a href=\"reserved.php\"> View items reserved </a></li>";
            echo "<li> <a href=\"viewfines.php\"> View outstanding with fines </a></li>";
            echo "</ul>";
            echo "<br><br>";

            if($row["is_admin"]==1)
            { 
                echo "<h3>Admin Menu</h3>";
                echo "<ul>";
                echo "<li> <a href=\"addmovie.php\"> Add a Movie </a></li>";
                echo "<li> <a href=\"addplayer.php\"> Add a Player </a></li>";
                echo "<li> <a href=\"adduser.php\"> Add a user </a></li>";
                echo "<li> <a href=\"adminsearch.php\"> Status of Movies </a></li>";
                echo "<li> <a href=\"stats.php\"> View interesting statistics </a></li>";
                echo "</ul>";
            }
        //Set session variables
            $_SESSION["uname"] = $userid;
            $_SESSION["fullname"] = $row["fname"] . " " . $row["lname"];
        }
        else
        {
            echo "Sorry! You don't have a login.";
        }
        $conn->close();
        
    }
?>
    <br><br>
    <a href="logout.php">Sign Out</a>
</body>
</html>