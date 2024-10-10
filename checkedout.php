<!DOCTYPE html>
<html>
<head>
    <title>Movies You Have Rented</title>
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
        $sql = "select * FROM transaction RIGHT JOIN movie ON transaction.movieid = movie.movieid RIGHT JOIN user ON transaction.userid = user.userid where transaction.userid = '$userid' and transaction.type = 1";
        $sql2 = "select * FROM transaction where userid = '$userid' and playerid like '%player%'";

        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>Movie ID</th>";
                echo "<th>Movie Name</th>";
                echo "<th>Date Borrowed</th>";
                echo "<th>Date Due</th>";
                echo "<th>&nbsp;</th>";
            echo "</tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['movieid'] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . $row['end_date'] . "</td>";
                    echo "<td>" ."<a href=return.php?movieid=".$row['movieid'] ."&trans_id=".$row['trans_id'].">Return</a>". "</td>";
                echo "</tr>";

            }
            echo "</table>"; 
        }
        else {
            echo "0 results";
        }

        echo "<br><br>";

        if ($result2->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>Player ID</th>";
                echo "<th>Date Borrowed</th>";
                echo "<th>Date Due</th>";
            echo "</tr>";
            // output data of each row
            while($row = $result2->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['playerid'] . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . $row['end_date'] . "</td>";
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

