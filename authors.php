<?php session_start(); ?>
<!DOCTYPE html>
<html>
<style>
body::-webkit-scrollbar{

}
div.a {
position: fixed;
top:5%;
left:3%;
border-radius: 15px;
width: 90%;
height:90%;
padding: 5px;
}
div.loglink{
position:fixed;
top: 1%;
right: 5%;
}
div.header{
position: relative;
top:2%;
height:14%;
margin: 0em;
margin-bottom: 1px;
}
div.superwrap{
position:absolute;
width:96%;
height:80%;
padding:3px;
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
margin-top:10px;
}
div.cardwrap{
padding:10px;
border:1px solid gray;
border-radius: 5px;
overflow: hidden;
}
div.txtwrap{
position:relative;
width:75%;
left:25%;
}
div.aimwrap{
position: absolute;
width:20%;
height: 120px;
left: 2%;
overflow: hidden;
}
.card{
height:130px;
position:relative;
width:100%;
}
div.title{
position:relative;
left:8px;
top:3px;
padding:5px;
font-family: Arial;
font-weight: 500;
font-size:24px;
}
div.article{
position:relative;
font-family: Arial;
font-size:12px;
padding: 4px;
left: 8px;
width:92%
}
img{
max-width:100%;
max-height:100%;
}
div.author{

}
.tablink{
color: black;
float: right;
border: none;
bottom: 0px;
cursor: pointer;
padding:10px 10px;
font-size: 17px;
width: 40%;
}
.tabname{
color: black;
float: right;
border: none;
bottom: 0px;
padding: 10px 10px;
font-size: 17px;
width: 40%;
}
div.tabwrap{
width:47%;
float:right;
position:absolute;
bottom: 1%;
right: 1%;
}
div.bannerwrap{
width:47%;
height:100%;
}
</style>
<div class="a">
	<div class="loglink">
		<?php
//		$auid = $_GET['authorID'];
//		$_SESSION["auid"] = $auid;

		if (! is_null($_SESSION["commenterID"])) {print 'Hi, '.$_SESSION["uname"].'!<br>'; print'<a href="logout.php" style="font-size:10px; align: right;">logout</a>';}
		else {print'<a href="login.php">login</a>';}

		print '<meta name="og:card" content="summary_large_image">';/*done*/
		print '<meta name="og:site" content="@FingerLakesTwo">';/*done*/
		print '<meta name="og:creator" content="@FingerLakesTwo">';/*done*/
		print '<meta name="og:title" content="Meet the Authors of FL2 dot com">';/*done*/
		print '<meta name="og:image" content="http://fingerlakes2.com/fingerlakesbanner.png">';



		?>
	</div> <!--/*end loglink div*/-->

	<div class="header">
		<div class="bannerwrap">
			<img src="genImages/fingerlakesbanner.png" alt="Finger Lakes 2" style="width:95%">
		</div>
		<div class="tabwrap">
			<button class="tablink" onclick="location.href='index.php'">Home</button>
			<!--<button class="tabname">Author Name</button>-->
		</div>
	</div> <!--/*end header div*/-->

<div class="b">
<div class="superwrap">
<?php
	$servername = "localhost";
        $dbusername = "sadewey";
        $dbpassword = "Sdew123?";
        $dbname = "fingerlakes2";
	$auid = $_GET['authorID'];

	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

		if ($conn->connect_error) {
                	die("Connection Failed: ". $connect_error);
				}
		$sql  = "SELECT `title`, articleID, Articles.authorID AS auid, SUBSTRING(`body`, 1, 400) AS body,`pubDate`, Authors.name AS author, Articles.imgloc AS imgsrc \n"

    		. "FROM `Articles` \n"

  		. "JOIN fingerlakes2.Authors WHERE Authors.authorID = Articles.authorID\n"

		."ORDER BY Articles.pubDate DESC";

		$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
	if ($row["auid"] == $auid) {
                print '<div class="cardwrap"><div class="aimwrap"><img src=articleimg/'.$row["imgsrc"].'></div><div class="txtwrap"><div class="card"><div class="title"><a href="article.php?articleid='.$row['articleID']
			.'">'
			.$row["title"].'</a></div><div class="article">'.$row["body"].'...</div></div></div></div>';
                      } 
	else {}
	}


?>
</div> <!--end of b-->
</div>
</div> <!--end of a-->
</html>
