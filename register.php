<?php session_start(); ?>

<!DOCTYPE html>
<html>
<body>

<style>
div.a {
  position: absolute;
  top: 20%;
  left:20%;
  border: 3px solid gray; 
  border-radius:15px;
  width:55%;
  height:65%;
  padding:5px;
  text-align:center;
}
div.w {
padding: 0px;
}
div.c{
position: absolute;
width: 70%;
left: 10%;
padding:5%;
}
button, input {
    height:5%;
    border radius:500px;
	width:100%;
	position: static;
	bottom: 10%;
}
</style>


<?php
$servername = "localhost";
$dbusername = "sadewey";
$dbpassword = "Sdew123?";
$dbname = "fingerlakes2";

$iffail = $taketwo = 0;
$uncheck = $pass = $conpass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if (empty($_POST["userName"])){$iffail=1;}
	else {$uncheck = $_POST["userName"];}

	if (empty($_POST["pass"])){$iffail=5;}
	else {$pass = $_POST["pass"];}

	if (empty($_POST["conpass"])){$iffail=6;}
	else {$conpass = $_POST["conpass"];}

	if (($iffail < 5) &&  ($pass != $conpass)){$iffail=7;}

	switch ($iffail) {
        case 0:

		$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                if ($conn->connect_error) {
                die("Connection Failed: ". $connect_error. " pleaase try again later.");
                }

                $sql = "SELECT *  FROM Commenter WHERE uname = '$uncheck'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                echo "Please select another username";
                $taketwo = 1;
                }

                if ($taketwo == 0){
                /*
                * SELECTS MAX CommenterID TO GET THE NEXT Commenter ID
                */
                $sql  = 'SELECT MAX(`commenterID`) AS "lastid" FROM `Commenter`';
                $result = $conn->query($sql);

                $nextCID = NULL;

                if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc())
                        {$nextCID = $row["lastid"] + 1;}
                    }

                $sql = "INSERT INTO Commenter VALUES ($nextCID, '$uncheck', '$pass')";

		if ($conn->query($sql) === TRUE){
			$_SESSION["commenterID"] = $nextRID;
			$_SESSION["uname"] = $uncheck;
			header("Location:index.php");
		}
		else {echo "Error: " . $sql . "<br>" . $conn->error;}

		}

		break;
        case 1:
                echo "please enter a valid username";
                break;
	case 5:
		echo "please enter a valid password";
		break;
	case 6:
		echo "please confirm your password";
        	break;
	case 7:
		echo "please make sure your username and password match";
		break;
	default:
                echo "you did something wrong";
        }

}

?>

<div class="a">
	<div class="w">

		<div class="c">
	<h3>Register:</h3>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">

					Username: <input type ="text" name="userName"><br>
					Password: <input type = "text" name="pass"><br>
					Confirm Password: <input type = "text" name="conpass"><br><br>
				<input type ="submit">

			</form>
		</div>
	</div>
</div>
</body>
</html>
