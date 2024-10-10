<!DOCTYPE html>
<html>
<head>
    <title>Lake Forest Store Stats</title>
    <h1>Lake Forest Store Stats</h1>
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
        $sql = "select fname, lname, rentals
                from user
                order by rentals DESC";
            
        $result = $conn->query($sql);
        echo"<h2>Most Frequent Renters</h2>";
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Total Number of Rentals</th>";
            echo "</tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['fname'] . "</td>";
                    echo "<td>" . $row["lname"] . "</td>";
                    echo "<td>" . $row['rentals'] . "</td>";

                echo "</tr>";

            }
            echo "</table>"; 
        }
        else {
            echo "0 results";
        }
        
         $sql2 = "select title, trented
                from movie
                order by trented DESC";
            
        $result2 = $conn->query($sql2);
        echo"<h2>Most Popular Movies</h2>";
        if ($result2->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>Number of Times Rented</th>";
            echo "</tr>";
            // output data of each row
            while($row = $result2->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['trented'] . "</td>";

                echo "</tr>";

            }
            echo "</table>"; 
        }
        else {
            echo "0 results";
        }
        
        $sql3 = "select AVG(fines)
                from user";
        $result3 = $conn->query($sql3);    
        echo"<h2>Fines</h2>";
        if ($result3->num_rows >= 0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>Average Fines</th>";
            echo "</tr>";
            // output data of each row
            while($row = $result3->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['AVG(fines)'] . "</td>";
           

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

