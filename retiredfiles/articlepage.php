<!DOCTYPE= html>
<HTML>
<style>
div.a {
position: fixed;
top:5%;
left:5%;
border-radius: 15px;
width: 90%;
height:90%;
padding: 10px;
}
div.header{
position: relative;
top:2%;
height:10%;
}
div.b{
position:relative;
overflow-y: scroll;
height: 80%;
top:10%;
width:100%;
border-radius: 15px;
border: 1px solid gray;
padding:5px
}

h1 {

  font-size: 40px;

}
</style>
<body>

<div class="a">
<div class="header">
        <a href="index.php"><img src="fingerlakesbanner.png" alt="Finger Lakes 2" style="width:50%"></a>
</div>
<div class="b">
<div class="superwrap">

<?php

$aid = $_GET['articleid'];

$servername = "localhost";
$dbusername = "sadewey";
$dbpassword = "Sdew123?";
$dbname = "fingerlakes2";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $connect_error);
		}

$sql = "SELECT `title`, articleID, `body` ,`pubDate`, Authors.name AS author \n"

                . "FROM `Articles` \n"

                . "JOIN fingerlakes2.Authors WHERE Authors.authorID = Articles.authorID \n"

                ."AND articleID =".$aid;


$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	print '<h1>'.$row["title"].'</h1><p style="color:#a6a6a6; white-space: pre-line;">By: '.$row["author"].'</p><br><br>'.$row["body"];
                       }
?>

</div>
</div>
</body>
</HTML>
