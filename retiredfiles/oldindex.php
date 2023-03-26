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
padding:5px
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
div.commwrap{
//border: 1px solid blue;
width:4%; //set to 4% when working on picture thing
height:120px;
position: absolute;
right: 1%;
overflow: hidden;
text-align: center;
}
div.aimwrap{
//border: 1px solid red;
align-items: center;
justify-content: center;
position: absolute;
width:20%;
height: 120px;
left: 6%; //set to 6% when working on picture thing
overflow: hidden;
}
.commnum{
top: 10%
left: 45%
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
</style>
<div class="a">
	<div class="loglink">
		<?php
		if (! is_null($_SESSION["commenterID"])) {print 'Hi, '.$_SESSION["uname"].'!<br>'; print'<a href="logout.php" style="font-size:10px; align: right;">logout</a>';}
		else {print'<a href="login.php">login</a>';}

		print '<meta name="og:card" content="summary_large_image">';/*done*/
		print '<meta name="og:site" content="@FingerLakesTwo">';/*done*/
		print '<meta name="og:creator" content="@FingerLakesTwo">';/*done*/
		print '<meta name="og:title" content="Your Number 1 Stop for Finger Lakes Region">';/*done*/
		print '<meta name="og:image" content="http://fingerlakes2.com/fingerlakesbanner.png">';



		?>
	</div>

	<div class="header">
	<img src="fingerlakesbanner.png" alt="Finger Lakes 2" style="width:50%">
	</div>
<div class="b">
<div class="superwrap">
<?php

	$servername = "localhost";
        $dbusername = "sadewey";
        $dbpassword = "Sdew123?";
        $dbname = "fingerlakes2";

	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

		if ($conn->connect_error) {
                	die("Connection Failed: ". $connect_error);
				}
//		$sql  = "SELECT `title`, articleID, SUBSTRING(`body`, 1, 400) AS body,`pubDate`, Authors.name AS author, Articles.imgloc AS imgsrc \n"

//    		. "FROM `Articles` \n"

//    		. "JOIN fingerlakes2.Authors WHERE Authors.authorID = Articles.authorID \n"

//		."ORDER BY Articles.pubDate DESC";

//		$sql  = "SELECT Articles.*, Authors.name, coms FROM Articles\n"

//		    . "	INNER JOIN Authors ON Authors.authorID = Articles.authorID\n"

//		        . "    INNER JOIN (\n"

//   		 . "SELECT Comments.articleID, COUNT(DISTINCT Comments.commentID) AS coms FROM Comments GROUP BY articleID) co ON Articles.articleID = co.articleID";

		$sql  = "SELECT Articles.title, Articles.articleID, SUBSTRING(Articles.body, 1, 400) AS body, Articles.pubDate, Articles.imgloc AS imgsrc, Authors.name, coms FROM Articles\n"

		    . "	INNER JOIN Authors ON Authors.authorID = Articles.authorID\n"

		    . "    INNER JOIN (\n"

		    . "SELECT Comments.articleID, COUNT(DISTINCT Comments.commentID) AS coms FROM Comments GROUP BY articleID ORDER BY articleID DESC) co ON Articles.articleID = co.articleID  \n"

		    . "ORDER BY `Articles`.`articleID`  DESC)";


		$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
                print '<div class="cardwrap"><div class="commwrap"><img src=commentbox2.png>'.$row["coms"].'</div><div class="aimwrap"><img src=../articleimg/'.$row["imgsrc"].'></div><div class="txtwrap"><div class="card"><div class="title"><a href="article.php?articleid='.$row['articleID']
			.'">'
			.$row["title"].'</a></div><div class="article">'.$row["body"].'...</div></div></div></div>';
                       }

?>
</div> <!--end of b-->
</div>
</div> <!--end of a-->
</html>

