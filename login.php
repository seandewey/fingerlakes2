<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
  </head>
<body>
<style>

div.a {
  position: absolute;
  top: 20%;
  left:20%;
  border: 1px solid gray;
  border-radius:15px;
  width:55%;
  height:60%;
  padding:10px;
  text-align:center;
}
div.b {
text-align: center;
position: absolute;
width: 70%;
left: 10%;
bottom:10px;
padding:5%;
}
div.c{
position: absolute;
width: 70%;
left: 10%;
top:10px;
padding:5%;
}
input[type=submit], input[type=text], input[type=password] {
height:5%;
border radius:500px;
width:100%;
position: static;
bottom: 10%;
}
button {
width:45%
}

</style>
<?php
//declaring sql variables
$servername = "localhost";
$dbusername = "sadewey";
$dbpassword = "Sdew123?";
$dbname = "fingerlakes2";

//veriables to check that the entered username and pass match the database
$uncheck = $pscheck = "";
$iffail = 0;

//Self Post jawn
if ($_SERVER["REQUEST_METHOD"] == "POST"){

	//checks to see a value was entered for username
	if (empty($_POST["username"])){$iffail=1;}
	else {$uncheck = $_POST["username"];}
	//checs to see if a value was entered for password
	if (empty($_POST["password"])){$iffail=1;}
	else {$pscheck = $_POST["password"];}

	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	if ($conn->connect_error) {
        die("Connection Failed: ". $connect_error);
        }
	//fetches user profile info for entered username
	$sql = "SELECT *  FROM Commenter WHERE uname = '$uncheck'";
	$result = $conn->query($sql);

	///IF results of the query arent null, proceed
	if ($result->num_rows > 0) {
	//go through the result row, checks entered pword with saved one in DB
        while($row = $result->fetch_assoc()) {
		if ($uncheck == $row["uname"] && $pscheck == $row["pword"]){
			$_SESSION["commenterID"] = $row["commenterID"];
			$_SESSION["uname"] = $row["uname"];
			header("Location:index.php");
			}
		else {echo "Incorrect Password, please try again";}
        	}
	}
	//IF query results were null, no username found
	else { $iffail= 1; echo "No user found by this Username. Please try again or Register.";}


}
?>

<div class="a">
	<div class="c">
		<h3> Commenter Login  </h3>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">

			Username: <input type ="text" name="username"><br>
			Password: <input type ="password" name="password"><br><br><br>

        <input type ="submit" value = "Log In"><br><br>

	</div>
	<div class="b">

	</form>

	<button onclick="window.location.href='register.php'">Register</button>
	<button onclick="window.location.href='authorlogin.php'">Author Login</button>

	</div>
</div>

</body>
</html>
