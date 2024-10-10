<!DOCTYPE html>
<html>
<head>
    <title>Rent a Player</title>
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
        $sql = "select * FROM player";
        
        echo "List of all available movie players: ";
        echo "<br><br>";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>Player ID</th>";
                echo "<th>Player Features</th>";
                echo "<th>&nbsp;</th>";
            echo "</tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['playerid'] . "</td>";
                    echo "<td>" . $row["features"] . "</td>";
                    echo "<td>" ."<a href=borrowplayer.php?playerid=".$row['playerid'] .">Rent</a>". "</td>";
                echo "</tr>";

            }
            echo "</table>"; 
        }
        else {
            echo "No Avaiable Players!";
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

