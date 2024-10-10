<!DOCTYPE html>
<html>
<head>
    <title>Create New User</title>
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
    First Name:  <input type="text" name="firstname"/>
	<br><br>
    Last Name:  <input type="text" name="lastname"/>
	<br><br>
    Email:  <input type="text" name="email"/>
	<br><br>
    User ID:  <input type="text" name="userid"/>
	<br><br>
    Password: <input type="password" name="password1"/>
    <br><br>
    Retype Password: <input type="password" name="password2"/>
    <br><br>
    Is this an Admin Account?<br>
    <input type="radio" id="User" name="is_admin" value="0">
    <label for="User">User</label><br>
    <input type="radio" id="Admin" name="is_admin" value="1">
    <label for="Admin">Admin</label><br>
    <input type="submit" value="Create User"/>&nbsp;&nbsp;&nbsp;&nbsp;
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

        $fname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
        $lname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $userid = isset($_POST["userid"]) ? $_POST["userid"] : "";
        $password = isset($_POST["password1"]) ? $_POST["password1"] : "";
        $is_admin = isset($_POST["is_admin"]) ? $_POST["is_admin"] : "";
        
	}
	if($userid!=""){
        //Create the SQL query
        $sql = "select userid from user";
        $sql = $sql . " where userid = '$userid'";
        
	//Run the query
	$result = $conn->query($sql);
    
    if ($result->num_rows == 0) 
	{
        $sql2 = "insert into user(fname,lname,email,userid,password,is_admin) values(";
        $sql2 = $sql2 . "'$fname','$lname','$email','$userid','$password', '$is_admin')";
	    $result = $conn->query($sql2);
        echo $sql2;
        if ($result === TRUE) 
            echo "Created User";
        else
            echo "Something went wrong!";
            
        echo "<br><a href=\"adduser.php\"> Add a user </a>";

    } 
    else
	{
        echo "Sorry! That userid already exists!";
        echo "<br><a href='adduser.php'>Try again</a>";
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