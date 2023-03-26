<?php session_start(); ?>
<!DOCTYPE html>
<html>
<style>
body::-webkit-scrollbar{

}
div.a {
position: fixed;
top:5%;
left:5%;
border-radius: 15px;
width: 90%;
height:90%;
padding: 10px;
}
div.loglink{
position:fixed;
top: 1%;
right: 5%;
}
div.header{
position: relative;
top:2%;
height:10%;
}
div.superwrap{
position:absolute;
width:96%;
height:80%;
padding:3px;
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
div.cardwrap{
padding:1px;
}
.card{
height:130px;
position:relative;
width:100%;
border:1px solid gray;
border-radius: 4px;
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
div.author{

}
</style>
<div class="a">
<div class="loglink"><a href="login.php">login</a></div>
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
		$sql  = "SELECT `title`, articleID, SUBSTRING(`body`, 1, 400) AS body,`pubDate`, Authors.name AS author \n"

    		. "FROM `Articles` \n"

    		. "JOIN fingerlakes2.Authors WHERE Authors.authorID = Articles.authorID \n"

		."ORDER BY Articles.pubDate DESC";

		$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
                print '<div class="cardwrap"><div class="card"><div class="title"><a href="articlepage.php?articleid='.$row['articleID']
			.'">'
			.$row["title"].'</a></div><div class="article">'.$row["body"].'...</div></div></div>';
                       }

?>
</div> <!--end of b-->
</div>
</div> <!--end of a-->
</html>
