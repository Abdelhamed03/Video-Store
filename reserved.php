<!DOCTYPE html>
<html>
<head>
    <title>Reservations</title>
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
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        //echo "Connected successfully<br>";
        
        $userid = $_SESSION["uname"];
        $sql = "select * FROM transaction RIGHT JOIN movie ON transaction.movieid = movie.movieid RIGHT JOIN user ON transaction.userid = user.userid where transaction.userid = '$userid' and transaction.type = 0";
            
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>Movie ID</th>";
                echo "<th>Movie Name</th>";
                echo "<th>Date Reserved</th>";
                echo "<th>Available</th>";
                echo "<th>&nbsp;</th>";
            echo "</tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['movieid'] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . $row['numofdisks'] . "</td>";
                    echo "<td>" ."<a href=reserveborrow.php?movieid=".$row['movieid'] ."&trans_id=".$row['trans_id']."&numofdisks=".$row['numofdisks'].">Borrow Now</a>". "</td>";
                echo "</tr>";

            }
            echo "</table>"; 
        }
        else {
            echo "0 results";
        }
        $conn->close();
    }
    else
    {
        echo "You are not supposed to be here!<br>";
        echo "<a href=\"index.html\">Login</a> to continue.";
    }
    ?>

<br>
<a href="welcome.php">Back To Menu</a>
</body>
</html>

