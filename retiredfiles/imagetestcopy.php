<!DOCTYPE= html> <HTML> <style> div.a { position: fixed; top:3%; left:3%; border-radius: 15px; width: 94%; height:90%; padding: 4px; border:1px 
solid orange;
}
div.header{
position: relative;
top:2%;
height:15%;
border: 1px solid blue;
}
div.b{
position:relative;
overflow-y: scroll;
height: 80%;
top:5%;
width:100%;
border-radius: 15px;
border: 1px solid gray;
padding:5px
}
div.imdiv{
position: relative;
width: 40%;
height:300px;
top: 3%;
border: 1px solid red;
overflow:auto;
}
div.titdiv{
position: absolute;
padding:3px;
right:1%;
top:1%;
width:58%;
border: 1px solid green;
}
div.writerpic{
position:realtive;
width: 25%;
border: 1px solid brown;
border-radius: 50%;
overflow: hidden;
}
div.writername{
position: absolute;
width: 70%;
border: 1px solid red;
left: 30%;
top: 1%;
}
.card{
position: relative;
width:40%;
border: 1px solid pink;
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
border: 1px solid yellow;
}

</style>
<body>

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

$sql = "SELECT `title`, articleID, `body` ,`pubDate`, Authors.name AS author, imgloc, Authors.imgloc AS authorimg \n"

                . "FROM `Articles` \n"

                . "JOIN fingerlakes2.Authors WHERE Authors.authorID = Articles.authorID \n"

                ."AND articleID =".$aid;


$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

<div class="a">

<div class="header">
        <a href="index.php"><img src="fingerlakesbanner.png" alt="Finger Lakes 2" style="width:50%"></a>
</div> <!-- header end -->
<div class="b">
	<div class="superwrap">
		<div class="imdiv">
			<img src="articleimg/45e6u7.jpg"> 
		</div> <!-- imdiv end -->
		<div class="titdiv">
			<h1>Beer Die voted the national past time of Dresden, New York </h1>
		 <!-- titdiv end -->
	<div class="card">
		<div class="writerpic">	
			<img src="authorimg/san.png" border-radius="15px">
		</div><!--writerpic end-->
		<div class="writername">
			<p style="color:#a6a6a6; font-size:20px;">By: Sue Anthony</p>
		</div>
	</div><!-- card end -->
	</div>
	</div><!-- superwrap end -->

body

</div> <!-- b end -->
</div> <!-- a end -->

}
?>
</body>
</HTML>
