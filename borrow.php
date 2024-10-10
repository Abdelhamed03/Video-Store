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
            $movieid = $_GET["movieid"]; // Change this
            $date = date("Y-m-d");
            $enddate = date('Y-m-d', strtotime("+30 days"));
            //Create the SQL query
            $sql2 = "select * from transaction, movie where userid = '$userid' and type = 1";
            $result = $conn->query($sql2);
            $numofdisks = $_GET["numofdisks"];
            if($numofdisks > 0)
            {
                if ($result->num_rows > 9){
                    echo "You have rented too many movies already. Please return one to rent another.";
                    echo "<br><br>";
                }
                else{
                $sql = "insert into transaction (start_date, end_date, type, movieid, userid) values";
                $sql = $sql. "('$date','$enddate',1,'$movieid','$userid')";
                //echo $sql;
                //Run the query
                $result = $conn->query($sql);

                $sql = "";
                //Create the SQL query
                $numofdisks = $_GET["numofdisks"];
                $sql = "update movie set numofdisks = numofdisks - 1 where movieid = '$movieid'";
                $sql2 = "update user set rentals = rentals + 1 where userid = '$userid'";
                $sql3 = "update movie set trented = trented + 1 where movieid = '$movieid'";
                //$sql = $sql. "movieid = '$movieid'";
                //echo $sql;
                //Run the query
                $result = $conn->query($sql);
                $result = $conn->query($sql2);
                $result = $conn->query($sql3);

                echo "<br>";
                echo "You have rented this movie successfully for 30 days!";
                echo "<br>";
                echo "Please return this movie by ";
                echo date('M d Y', strtotime($enddate));
                echo "<br><br>";
                echo "If you would like to see your currently rented movies please click the button below.";
                echo "<br><br>";
                echo "<a href='checkedout.php'>My Current Rent List</a>";
                echo "<br><br>";
                }
            }
            else{
                echo "You cannot rent this movie because there are no disks available.<br>You can reserve it and be notified when it becomes available again.";
                echo "<br><br>";
                echo "<a href='searchFancy.php'>Search for another movie</a>";
                echo "<br><br>";
            }
        $conn->close();
    
        }
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

