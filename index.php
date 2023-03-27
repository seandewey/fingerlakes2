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
padding:5px
margin: 0em;
margin-top: 10px;
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
div.commwrap{
//border: 1px solid blue;
width:4%; //set to 4% when working on picture thing
height:120px;
position: absolute;
right: 1%;
overflow: hidden;
text-align: center;
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
  outline: none;
  cursor: pointer;
  padding: 10px 10px;
  font-size: 17px;
  width: 40%;
}
div.tabwrap{
width: 47%;
float:right;
position: absolute;
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
		if (! is_null($_SESSION["commenterID"])) {print 'Hi, '.$_SESSION["uname"].'!<br>'; print'<a href="logout.php" style="font-size:10px; align: right;">logout</a>';}
		else {print'<a href="login.php">login</a>';}

		print '<meta name="og:card" content="summary_large_image">';/*done*/
		print '<meta name="og:site" content="@FingerLakesTwo">';/*done*/
		print '<meta name="og:creator" content="@FingerLakesTwo">';/*done*/
		print '<meta name="og:title" content="Your Number 1 Stop for Finger Lakes Region">';/*done*/
		print '<meta name="og:image" content="http://fingerlakes2.com/fingerlakesbanner.png">';



		?>
	</div> <!--/*end loglink div*/-->

	<div class="header">
		<div class="bannerwrap"><img src="genImages/fingerlakesbanner.png" alt="Finger Lakes 2" style="width:95%"></div>

	<div class="tabwrap">
	<button class="tablink" onclick="openPage(event, 'articles')" id="defaultOpen">Home</button>
        <button class="tablink" onclick="openPage(event, 'Authors')">Authors</button>

	</div>
	</div> <!--/*end header div */-->


<div class="b">
<div id="articles" class="superwrap">
<?php

	$servername = "localhost";
        $dbusername = "sadewey";
        $dbpassword = "Sdew123?";
        $dbname = "fingerlakes2";

	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

		if ($conn->connect_error) {
                	die("Connection Failed: ". $connect_error);
				}

		$sql  = "SELECT Articles.title, Articles.articleID, SUBSTRING(Articles.body, 1, 400) AS body, Articles.pubDate, Articles.imgloc AS imgsrc, Authors.name, coms FROM Articles\n"

                    . " INNER JOIN Authors ON Authors.authorID = Articles.authorID\n"

                    . "    INNER JOIN"

                    . "(SELECT Comments.articleID, COUNT(DISTINCT Comments.commentID) AS coms FROM Comments GROUP BY articleID ORDER BY articleID DESC) co ON Articles.articleID = co.articleID  \n"

                    . "ORDER BY `Articles`.`articleID`  DESC";

		$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
                print '<div class="cardwrap">'

				.'<div class="commwrap">'
                        		.'<img src=commentbox.png>'
                		.$row["coms"]
				.'</div>'

				.'<div class="aimwrap">'
					.'<img src=articleimg/'.$row["imgsrc"].'>'
				.'</div>'

				.'<div class="txtwrap">'
					.'<div class="card">'
						.'<div class="title">'
							.'<a href="article.php?articleid='
								.$row['articleID']
							.'">'
							.$row["title"]
							.'</a>'
						.'</div>'
						.'<div class="article">'
							.$row["body"]
						.'...</div>'
					.'</div>'
				.'</div>'

		     .'</div>';
                       }

?>

</div> <!--end of articles-->

<div id="Authors" class="superwrap">
<?php
	$servername = "localhost";
        $dbusername = "sadewey";
        $dbpassword = "Sdew123?";
        $dbname = "fingerlakes2";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                if ($conn->connect_error) {
                        die("Connection Failed: ". $connect_error);
                                }
	$sql  = "SELECT authorID, name, imgloc, Description FROM `Authors`";

	$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	print '<div class="cardwrap">'

		.'<div class="aimwrap">'
			.'<img src=authorimg/'.$row["imgloc"].'>'
		.'</div>'

		.'<div class="txtwrap">'
			.'<div class="card">'
				.'<div class="title">'
					.'<a href=authors.php?authorID='
					.$row["authorID"]
					.'>'
						.$row["name"]
					.'</a>'
				.'</div>'

				.'<div class="article">'
					.$row["Description"]
				.'</div>'
			.'</div>'
		.'</div>'

	     .'</div>';
}
?>
    </div> <!--end of Authors-->
  </div> <!--end of b-->
</div> <!--end of a-->





<!--/*Start of Javascript functions*/-->
<script>
function openPage(evt, Choice){
var i, superwrap, tablink;

superwrap = document.getElementsByClassName("superwrap");

  for (i = 0; i < superwrap.length; i++) {
    superwrap[i].style.display = "none";
  }

tablink = document.getElementsByClassName("tablink");

for (i = 0; i < tablink.length; i++) {
    tablink[i].className = tablink[i].className.replace(" active", "");
  }

document.getElementById(Choice).style.display = "block";
  evt.currentTarget.className += " active";

}/*end function openpage*/

document.getElementById("defaultOpen").click();

</script>
<!--/*end of Javascript Functions*/-->
</html>
