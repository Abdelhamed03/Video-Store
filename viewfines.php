<!DOCTYPE html>
<html>
<head><title>Fines</title></head>
    
<body>
<h1>Customer Outstanding Fines</h1>
    
<?php
    session_start();
    if (isset($_SESSION["uname"]) && $_SESSION["uname"]!="")
    {   
        echo $_SESSION["fullname"];
        echo "<br><br><br>";
  
            
        
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
            $date = date("Y-m-d");
            $query = "Select title, DATEDIFF(NOW(),end_date)*2.5 AS fine
                      FROM transaction, movie
                      WHERE transaction.userid='$userid' and DATEDIFF(NOW(),end_date)>0 and transaction.movieID=movie.movieID";
            
            $result = $conn->query($query);
            
            if($result<>false){
            if(mysqli_num_rows($result)==false)
            {
                echo "<h2>You have no fines</h2>";
            }
            else{
                 echo "<h2>Fines for Overdue Movies</h2>";
                 echo "<table>";
                 echo "<tr><th>Title</th><th>Due Date</th><th>Fine</th></tr>";
                 while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['title']}</td><td>{$row['end_date']}</td><td>\${$row['fine']}</td></tr>";
                 }
                 echo "</table>";
            } 
            }


            
            
            
          
        $conn->close();
    
    }
    
?>
    


    
<?php
      }
    else
    {
        echo "You are not supposed to be here!<br>";
        echo "<a href=\"index.html\">Login</a> to continue.";
    }
?>
   <a href="welcome.php">Back</a>  
</body>
</html>