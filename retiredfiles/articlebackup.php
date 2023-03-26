<?php session_start(); ?>
<!DOCTYPE= html>
<HTML>
<style>
div.a {
position: fixed;
top:5%;
left:3%;
border-radius: 15px;
width: 90%; height:90%;
padding: 5px;
}
div.header{
position: relative;
top:2%;
height:14%;
margin: 0em;
margin-bottom: 1px;
}
div.b{
position:absolute;
overflow-y: scroll;
height: 90%;
top:15%;
width:100%;
border-radius: 15px;
border: 1px solid gray;
padding:5px;
margin: 0em;
margin-top: 10px;
}
div.imdiv{
position: relative;
width: 40%;
height:300px;
top: 3%;
overflow:auto;
}
div.titdiv{
position: absolute;
padding:3px;
right:1%;
top:1%;
width:58%;
}
div.writerpic{
position:realtive;
width: 25%;
border-radius: 50%;
overflow: hidden;
}
div.writername{
position: absolute;
width: 70%;
left: 30%;
top: 1%;
}
.card{
position: relative;
width:46%;
left: 5%;
}
h1 {
font-size: 40px;
}
img{
max-width:100%;
max-height:100%;
}
div.superwrap{
padding: 3px;
}
div.comwrap{
position: absolute;
width: 24%;
border: 1px solid black;
border-radius: 15px;
right:8px;
bottom: 0;
height:12%;
padding: 3px;
background-color:rgba(0,0,0,0.07);
}
div.comwrap:hover{
cursor: pointer;
}
div.comm{
position: relative;
border:1px solid rgba(0,0,0,0.07);
width: 99%;
height: 90px;
}
div.comdtime{
position: absolute;
color: gray;
top:0;
right:0;
}
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.modal-content {
background-color: #fefefe;
margin: auto;
padding: 20px;
border: 1px solid #888;
width: 50%;
height:70%;
}
div.commwin{
border:1px solid rgba(0,0,0,0.4);
height:80%;
padding: 2px;
overflow:scroll;
}
.close {
color: #aaaaaa;
float: right;
font-size: 28px;
font-weight: bold;
}
.close:hover,
.close:focus {
color: #000;
text-decoration: none;
cursor: pointer;
}

.tablink{
color: black;
float: right;
border: none;
bottom: 0px;
outline: none;
cursor: pointer;
padding: 10px 10px;
font-size: 17px;
width: 40%;
}
div.tabwrap{
width:47%;
float: right;
position: absolute;
bottom: 1%;
right: 1%;
}
div.bannerwrap{
width: 47%;
height: 100%;
}
</style>
<body>

<?php

$aid = $_GET['articleid'];
$_SESSION["aid"] = $aid;

$servername = "localhost";
$dbusername = "sadewey";
$dbpassword = "Sdew123?";
$dbname = "fingerlakes2";

$body = $title = $aut = $pubdate = $authorimg = $imgloc = "";
$lastcid = $nextcid = NULL;
$numoc = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$commentbod = $_POST["comment"];

	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	if ($conn->connect_error) {
        	die("Connection Failed: ". $connect_error);
                	}
	$sql = 'SELECT MAX(commentID) AS lastcid FROM Comments';
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
	$lastcid = $row["lastcid"];
	$nextcid = $lastcid + 1;
	}

	$sql  = 'INSERT INTO `Comments`(`commentID`, `commenterID`, `articleID`, `comDate`, `body`)'
		.' VALUES ('.$nextcid.','.$_SESSION["commenterID"].','.$_SESSION["aid"].',"'.date("Y-m-d H:i:s").'","'.$commentbod.'")';

	if ($conn->query($sql) === TRUE){
		}
	else {echo "Error: " . $sql . "<br>" . $conn->error;}


}

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
        die("Connection Failed: ". $connect_error);
                }
$sql = 'SELECT COUNT(commentID) AS num FROM Comments WHERE articleID = '.$aid;

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
$numoc = $row["num"];
}



$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
        die("Connection Failed: ". $connect_error);
                }

$sql = "SELECT `title`, articleID, `body` ,`pubDate`, Authors.name AS author, Articles.imgloc, Authors.imgloc AS authorimg \n"

                . "FROM `Articles` \n"

                . "JOIN fingerlakes2.Authors WHERE Authors.authorID = Articles.authorID \n"

                ."AND articleID =".$aid;


$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
$body = $row["body"];
$title = $row["title"];
$aut = $row["author"];
$pubdate = $row["pubDate"];
$authorimg = $row["authorimg"];
$imgloc = $row["imgloc"];
$articleID = $row["articleID"];

$homelink=" \'index.php\' ";
print $homelink;
}

print '<meta name="og:card" content="summary_large_image">';/*done*/
print '<meta name="og:site" content="@FingerLakesTwo">';/*done*/
print '<meta name="og:creator" content="@FingerLakesTwo">';/*done*/
print '<meta name="og:title" content="'.$title.'">';/*done*/
print '<meta name="og:image" content="http://fingerlakes2.com/articleimg/'.$imgloc.'">';



$sql  = "SELECT `commentID`, Comments.commenterID, articleID, body, DATE_FORMAT(comDate, '%m/%d/%Y %r') AS comdate, Commenter.uname\n"

    . "FROM `Comments` \n"

    . "JOIN Commenter\n"

    . "WHERE Commenter.commenterID = Comments.commenterID AND articleID = ".$aid;
$result = $conn->query($sql);


print '<div class="a">'
.'<div class="header">'
	.'<div class="bannerwrap">'
        	.'<a href="index.php"><img src="fingerlakesbanner.png" alt="Finger Lakes 2" style="width:95%"></a>'
	.'</div>'

	.'<div class="tabwrap">'
		.'<button class="tablink" onclick="Location.href="> Home </button>'
	.'</div>'

.'</div>'
.'<div class="b">'
	.'<div class="superwrap">'
		.'<div class="imdiv">'
			.'<img src=articleimg/'.$imgloc.'>'
		.'</div>'
		.'<div class="titdiv">'
			.'<h1>'.$title.'</h1>'
	.'<div class="card">'
		.'<div class="writerpic">'
			.'<img src=authorimg/'.$authorimg.' border-radius="15px">'
		.'</div>'
		.'<div class="writername">'
			.'<p style="color:#a6a6a6; font-size:20px;">By:'.$aut.'</p>'
			.'<p style="color:#a6a6a6; font-size:16px;">'.$pubdate.'</p>'
		.'</div>'
	.'</div>'
		.'<div class="comwrap" id="commod" onclick="commod()">'
			.'<img src="comment.png" style="width:35%; left:0;">'
			.'<span style="font-family:Arial; text-align:right; position:absolute; padding: 5px 0;">Comments['.$numoc.']</span>'
		.'</div>'
		.'<div id="modwin" class="modal">'
			.'<div class="modal-content">'
			.'<span class="close" onclick="closecom()">&times;</span>'
				.'<div class="commwin">';
			while ($row = $result->fetch_assoc()){
				print '<div class="comm">'
					.'<u><b>'.$row["uname"].': </b></u><div class="comdtime">'.$row["comdate"].'</div><br>'.$row["body"]
				.'</div>';
				} print '</div>';
			if (is_null($_SESSION["commenterID"])){
				print '<button onclick="gotolog()">Log In to comment</button>';
				}
			else {
				print '<form action="'.htmlspecialchars($_SERVER["PHP_SELF".'?articleID='.$aid]).'"  method="post">'

				.'<textarea id="comment" name="comment" rows="4" cols="70" maxlength="300">'
				.'</textarea>'
				.'<input type="submit" value="Send">'
				.'</form>';
				}
			print '</div>'
		.'</div>'
	.'</div>'
	.'</div>'
.$body
.'</div>'
.'</div>';
?>
<script>
var modal = document.getElementById("modwin");

function gotolog() {
window.location.href="login.php";
}

function commod() {
modal.style.display = "block";
}

function closecom() {
modal.style.display = "none";
}

window.onclick = function(event) {
if (event.target == modal) {
  modal.style.display = "none";
  }

}
</script>
</body>
</HTML>
