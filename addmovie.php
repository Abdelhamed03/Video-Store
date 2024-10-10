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
    Title:  <input type="text" name="title"/>
	<br><br>
    Producer:  <input type="text" name="producer"/>
	<br><br>
    Director:  <input type="text" name="director"/>
	<br><br>
    Movie ID:  <input type="text" name="movieid"/>
	<br><br>
    Genre:  <input type="text" name="genre"/>
    <br><br>
    Actor1:  <input type="text" name="actor1"/>
    <br><br>
    Actor2:  <input type="text" name="actor2"/>
    <br><br>
    <label for="numofdisks">Add or Remove disks:  </label>
    <input type="number" id="numofdisks" name="numofdisks" min="-10" max="10">
    <br><br>
    <input type="submit" value="Add Movie to DataBase"/>&nbsp;&nbsp;&nbsp;&nbsp;
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

        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $producer = isset($_POST["producer"]) ? $_POST["producer"] : "";
        $director = isset($_POST["director"]) ? $_POST["director"] : "";
        $movieid = isset($_POST["movieid"]) ? $_POST["movieid"] : "";
        $genre = isset($_POST["genre"]) ? $_POST["genre"] : "";
        $actor1 = isset($_POST["actor1"]) ? $_POST["actor1"] : "";
        $actor2 = isset($_POST["actor2"]) ? $_POST["actor2"] : "";
        $numofdisks = isset($_POST["numofdisks"]) ? $_POST["numofdisks"] : "";
        
	}
	if($movieid!=""){
        //Create the SQL query
        $sql = "select movieid from movie";
        $sql = $sql . " where movieid = '$movieid'";
        
	//Run the query
	$result = $conn->query($sql);
    
    if ($result->num_rows == 0) 
	{
        $sql2 = "insert into movie(title,producer,director,movieid,genre,actor1,actor2,numofdisks) values(";
        $sql2 = $sql2 . "'$title','$producer','$director','$movieid','$genre', '$actor1','$actor2','$numofdisks')";
	    $result = $conn->query($sql2);
        //echo $sql2;
        if ($result === TRUE) 
            echo "Adding Movie";
        else
            echo "Something went wrong!";
            
        echo "<br><a href=\"addmovie.php\"> Add a Movie </a>";

    } 
    else
	{
        $sql3 = "UPDATE movie SET numofdisks = numofdisks + '$numofdisks' WHERE movieid = '$movieid'";
        $result = $conn->query($sql3);
        if ($result === TRUE) 
            echo "Adding Movie";
        else
            echo "Something went wrong!";
        
        echo "<br><a href=\"addmovie.php\"> Add a Movie </a>";
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