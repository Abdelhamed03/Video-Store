<!DOCTYPE html>
<html>
<head>
    <title>Return A Movie</title>
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
            $transid = $_GET["trans_id"];
            $date = date("Y-m-d");
            $sql2 = "select end_date from transaction where movieid = '$movieid' and userid = '$userid' and trans_id = '$transid'";
            if ($date > $sql2)
            {
                echo "You have Outstanding Fines";
                echo "<br><br>";
                echo "<a href=viewfines.php>To view your fines</a>";
            }
            else{
                echo "You have returned it on time";
            }
            //Create the SQL query
            $sql = "DELETE FROM transaction WHERE movieid= '$movieid' and userid = '$userid' and type = 1 and trans_id = '$transid'";
            //echo $sql;
	       	//Run the query
	        $result = $conn->query($sql);

            $sql = "";
            //Create the SQL query
            $sql = "update movie set numofdisks = numofdisks + 1 where movieid = '$movieid'";
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
<br><br>
If you would like to see your currently rented movies please click the button below.
<br><br>
<a href="checkedout.php">My Current Rent List</a>
<br><br>
<a href="welcome.php">Back to Main Menu</a>
</body>
</html>

