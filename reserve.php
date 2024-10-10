<!DOCTYPE html>
<html>
<head>
    <title>Reserve A Movie</title>
    <style>
    
        table, th, td, tr {
            border: solid black;
            border-collapse: collapse
        }
        
    </style>
</head>
<body>
<?php
    //Set Session Variables
    session_start();
    if (isset($_SESSION["uname"]))
    {
        
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "videostore";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
       
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            //echo "Connected successfully<br>";

            $userid = $_SESSION["uname"];
            $movieid = $_GET["movieid"]; // Change this
            $date = date("Y-m-d");;
            //Create the SQL query
            $sql = "insert into transaction (start_date, type, movieid, userid) values";
            $sql = $sql. "('$date',0,'$movieid','$userid')";
            //echo $sql;
	       	//Run the query
	        $result = $conn->query($sql);
        
        $conn->close();
    
        }
    }
    else
    {
        echo("<h2>Please log into your Book Store Account first!");
        echo "<br><a href='index.php'>Try again</a>";
        header("index.php");
    }
    
  
?>
<br>
You have been put on the reservation list for this movie!
<br>
You will be notified once it becomes available again.
<br><br>
If you would like to see your current reservations please click the button below.
<br><br>
<a href="reserved.php">My Current Reservations</a>
<br><br>
<a href="welcome.php">Back to Main Menu</a>
</body>
</html>

