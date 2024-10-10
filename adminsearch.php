<!DOCTYPE html>
<html>
<head>
    <title>Search For  a Movie</title>
    <style>
    
        table, th, td, tr {
            border: solid grey;
			border-collapse:collapse;
        }
    </style>
	
	<script>
			function magic()
			{
				document.getElementById("submitButton").type = "submit";
				//document.getElementById("myForm").submit();				
			}
	</script>
</head>

<?php
    session_start();
    if (isset($_SESSION["uname"]) && $_SESSION["uname"]!="")
    { 
        echo $_SESSION["fullname"];
        echo "<br><br><br>";
  
?>

<body>
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="myForm">
    Movie Name:  <input type="text" name="title" id="title"/>
    <br><br>
    Movie Genre: <input type="text" name="genre" id="genre"/>
    <br><br>
	Movie Producer: <input type="text" name="producer" id="producer"/>
    <br><br>
	Movie Director: <input type="text" name="director" id="director"/>
    <br><br>
	Actor: <input type="text" name="actor" id="actor"/>
    <br><br>

    <input type="button" value = "Submit" onclick='magic()' id="submitButton"/>
	<br><br>
	Back to menu <a href="welcome.php">here</a>.

</form>
<br>
<hr>
<br>
<?php
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

	if(isset($_GET["title"]) or isset($_GET["director"]) or isset($_GET["genre"]) or isset($_GET["producer"]) or isset($_GET["actor"]))
	{	
		$title = isset($_GET["title"])?$_GET["title"]:"";
		$director = isset($_GET["director"])?$_GET["director"]:"";
		$genre = isset($_GET["genre"])?$_GET["genre"]:"";
		$producer = isset($_GET["producer"])?$_GET["producer"]:"";
		$actor = isset($_GET["actor"])?$_GET["actor"]:"";
		
		if($title == "" and $director == "" and $genre == "" and $producer == "" and $actor == "")
			$sql = "select * from MOVIE";
		else if($title!= "" and $director == "" and $genre == "" and $producer == "" and $actor == "")
			$sql = "select * from MOVIE where title like '%$title%'";
		else if($title == "" and $director!= "" and $genre == "" and $producer == "" and $actor == "")
			$sql = "select * from MOVIE where director like '%$director%'";
		else if($title == "" and $director == "" and $genre!= "" and $producer == "" and $actor == "")
			$sql = "select * from MOVIE where genre like '%$genre%'";
		else if($title == "" and $director == "" and $genre == "" and $producer!= "" and $actor == "")
			$sql = "select * from MOVIE where producer like '%$producer%'";
		else if($title == "" and $director == "" and $genre == "" and $producer == "" and $actor!= "")
			$sql = "select * from MOVIE where actor1 like '%$actor%' or actor2 like '%$actor%'";
		else
			$sql = "select * from MOVIE where (actor1 like '%$actor%' or actor2 like '%$actor%') and title like '%$title%' and director like '%$director%' and genre like '%$genre%' and producer like '%$producer%'";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table>";
			echo "<tr>";
				echo "<th>Title</th>";
				echo "<th>Genre</th>";
				echo "<th>Producer</th>";
				echo "<th>Director</th>";
				echo "<th>Actors</th>";
				echo "<th>Available Disks</th>";
				echo "<th>&nbsp;</th>";
			echo "</tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
					echo "<td>" . $row['title'] . "</td>";
					echo "<td>" . $row['genre'] . "</td>";
					echo "<td>" . $row['producer'] . "</td>";
					echo "<td>" . $row['director'] . "</td>";
					echo "<td>" . $row['actor1'] . " and " . $row['actor2'] . "</td>";
					echo "<td>" . $row['numofdisks'] . "</td>";
					echo "<td>" ."<a href=status.php?movieid=".$row['movieid'] .">Status of Movie</a>". "</td>";
				echo "</tr>";

			}
			echo "</table>";
		}  
		else {
			echo "0 results";
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