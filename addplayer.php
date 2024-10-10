<!DOCTYPE html>
<html>
<head>
    <title>Add a New Movie</title>
    <style>
    
        table, th, td, tr {
            border: solid black;
            border-collapse: collapse
        }
        
    </style>
</head>

<?php
    session_start();
    if (isset($_SESSION["uname"]) && $_SESSION["uname"]!="")
    {  
        echo $_SESSION["fullname"];
        echo "<br><br><br>";
  
?>


<body>
 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Player ID:  <input type="text" name="playerid"/>
	<br><br>
    Features:  <input type="text" name="features"/>
	<br><br>
    <input type="submit" value="Add a Player"/>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="reset" value="Clear"/>
    <br><br>
    Back to menu <a href="welcome.php">here</a>.
</form>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "videostore";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql="";
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        //echo "Connected successfully<br>";

        $playerid = isset($_POST["playerid"]) ? $_POST["playerid"] : "";
        $features = isset($_POST["features"]) ? $_POST["features"] : "";
        
	}
	if($playerid!=""){
        //Create the SQL query
        $sql = "select playerid from player";
        $sql = $sql . " where playerid = '$playerid'";
        
	//Run the query
	$result = $conn->query($sql);
    
    if ($result->num_rows == 0) 
	{
        $sql2 = "insert into player(playerid,features) values(";
        $sql2 = $sql2 . "'$playerid','$features')";
	    $result = $conn->query($sql2);
        //echo $sql2;
        if ($result === TRUE) 
            echo "Adding Player";
        else
            echo "Something went wrong!";
            
        echo "<br><a href=\"addplayer.php\"> Add a Player </a>";

    } 
    else
	{
        echo "Sorry! That playerid already exists!";
        echo "<br><a href='addplayer.php'>Try again</a>";
    }
    }
    $conn->close();
    
?>

<?php
      }
    else
    {
        echo "You are not supposed to be here!<br>";
        echo "<a href=\"index.html\">Login</a> to continue.";
    }
?>

</body>
</html>