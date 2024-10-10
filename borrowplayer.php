<!DOCTYPE html>
<html>
<head>
    <title>Rent A Movie</title>
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
            $playerid = $_GET["playerid"]; // Change this
            $date = date("Y-m-d");
            $enddate = date('Y-m-d', strtotime("+30 days"));
            //Create the SQL query
            $sql2 = "select * from transaction where userid = '$userid' and playerid<>Null";
            $result = $conn->query($sql2);
            echo "$sql2";
            if ($result->num_rows > 0){
                echo "You have rented too many players already. Please return one to rent another.";
                echo "<br><br>";
            }
            else{
            $sql = "insert into transaction (start_date, end_date, type, playerid, userid) values";
            $sql = $sql. "('$date','$enddate',1,'$playerid','$userid')";
            //echo $sql;
            //Run the query
            $result = $conn->query($sql);

            $sql = "";
            //Create the SQL query
            $sql = "DELETE FROM player WHERE playerid='$playerid'";
            //$sql = $sql. "movieid = '$movieid'";
            //echo $sql;
            //Run the query
            $result = $conn->query($sql);

            echo "<br>";
            echo "You have rented this player successfully for 30 days!";
            echo "<br>";
            echo "Please return this player by ";
            echo date('M d Y', strtotime($enddate));
            echo "<br><br>";
            echo "If you would like to see your currently rented movies and players please click the button below.";
            echo "<br><br>";
            echo "<a href='checkedout.php'>My Current Rent List</a>";
            echo "<br><br>";
            }
        }
        $conn->close();
    
        }
    else
    {
        echo("<h2>Please log into your Account first!");
        echo "<br><a href='index.php'>Try again</a>";
        header("index.php");
    }
    
  
?>
<a href="welcome.php">Back to Main Menu</a>
</body>
</html>

