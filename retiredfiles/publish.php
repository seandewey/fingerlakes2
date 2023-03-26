<?php session_start(); ?>
<!DOCTYPE html>
<html>

<?php
$servername = "localhost";
$dbusername = "sadewey";
$dbpassword = "Sdew123?";
$dbname = "fingerlakes2";
$atitle = $abody = NULL;
$aauthor = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST"){

$atitle = $_POST["title"];
$abody = $_POST["body"];
$aauthor = $_POST["author"];

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) { die("Connection Failed: ". $connect_error. " pleaase try again later."); }

$sql = 'SELECT MAX(`articleID`) as "lastid" FROM `Articles`';
$result = $conn->query($sql);

$nextAID = NULL;

if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc())
       {$nextAID = $row["lastid"] + 1;}
        }



$sql  = 'INSERT INTO `Articles`(`articleID`, `authorID`, `body`, `title`, `pubDate`) VALUES ('.$nextAID.','.$aauthor.',"'.$abody.'","'.$atitle.'","'.date("Y-m-d").'")';

if ($conn->query($sql) === TRUE){
			header("Location:publish.php");
		}
		else {echo "Error: " . $sql . "<br>" . $conn->error;}

}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">

<label for="author">Choose a Submitting Author:</label>

<?php
$owner = $_SESSION["ownerID"];

$servername = "localhost";
$dbusername = "sadewey";
$dbpassword = "Sdew123?";
$dbname = "fingerlakes2";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $connect_error);
	}

$sql  = 'SELECT * FROM `Authors` WHERE `ownerID` = '.$owner;

$result = $conn->query($sql);

print '<select id="author" name="author">';

        while($row = $result->fetch_assoc()) {
                print '<option value='.$row["authorID"].'>'.$row["name"].'</option>';
                       }
print '</select>';

?>
<br>
<br>
<label for="title">Article Title:</label>
<textarea id="title" name ="title" rows ="1" cols = "100" required></textarea><br>

<label for="body">Article Body:</label>
<textarea id="body" name="body" rows="25" cols="100" required></textarea>

  <br><br>

  <input type="submit" value="Publish">

</form>

</html>
