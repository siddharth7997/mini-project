
<?php
if($_POST["comments"]==NULL)
{header('Location:redirect.html'); 
exit;}

$text=$text.utf8_encode(htmlentities($_POST["comments"]));
$text=$text.".";
//===================================================================
if($_POST["language"]=="german")
{
$d=fopen("dictionaries/german",r);	
}
else if($_POST["language"]=="english")
{$d=fopen("dictionaries/large",r);

}
else if($_POST["language"]=="french")
{$d=fopen("dictionaries/french",r);
}
else if($_POST["language"]=="portugese")
{$d=fopen("dictionaries/portugese",r);
}
else if($_POST["language"]=="spanish")
{$d=fopen("dictionaries/spanish.dic",r);

}
//============================================================================
$temporary;
$dictionary=[];
for($i=0;!feof($d);$i++)
{fscanf($d,"%s\n",$temporary);
$dictionary[$temporary]=true;
}
//===========================================================================
$word=array();
$temp="";
$w=0;
$i=0;
for($i=0;$i<strlen($text);$i++)
{
if($text[$i]==PHP_EOL)
$text[$i]=".";
}
for($i=0;$i<strlen($text);$i++)
{
$c=$text[$i];
if($c==' '||$c=='.'||$c==','||$c==':'||$c==';'||$c=='-'||$c=='!'||$c=='?'||$c==')'||$c=='('||$c=='"'||$c==')'||$c=="\r")
{
if(strlen($temp)>0)
{$word[$w]=$temp;
$word[$w]=strtolower($word[$w]);
$w++;
$temp="";
}
}
else
{
	$temp.=$c;
}
}
//================================================================================================================
$wrong=array();
$index=0;
for($i=0;$i<count($word);$i++)
 {	 if(strpos($word[$i],"'")||preg_match('/[0-9]/',$word[$i]))
	{
 	continue;
	}
if (!isset($dictionary[strtolower($word[$i])]))
      {
            $wrong[$index]=$word[$i];
            $index++;   
      }
	}
 	
//======================================================================
?>
<html>
	<head>
		<div>
	<?php

	echo "<h1><center><big>WELCOME TO SPELLCHECK" . $_POST["username"] . "</big></h1>";
	
	?>

</div>
		<style>
			body {
    background-image: url('http://blog.hostbaby.com/wp-content/uploads/2014/03/PaintSquares_1920x1234.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
    background-size:cover;
	}
	#txt
		{color:blue;
			text-align:right;
				border:black;
				border-width:1px;
		}
		</style>
	<title>Form</title>
	</head>
	<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML=today;
    var t = setTimeout(startTime,1000);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
	<body onload="startTime()">
		<div id="txt"></div>
<br>
	<div><b>THE TEXT YOU ENTERED IS:-<br>
	<?php
	echo "<h2>".$_POST["comments"]."<br>";
	echo "<br>"."<br>";
?><center>
	<?php
	echo "no of wrongwords is :".count($wrong)."<br>";
	if(count($wrong)==0)
	echo '<img src="http://www.sedgleyparkprimary.org.uk/sampled/1865755/930/0/notbigger" alt="icon" />';
	else
	{echo "<h2>LOOKS LIKE YOU NEED SOME SPELLING PRACTISE IN ".$_POST["language"]."<br>";
		echo '<img src="https://s-media-cache-ak0.pinimg.com/236x/53/38/ff/5338ff1e5366a003a0ea19274bef1898.jpg" alt="icon" />'.'<br>';
	
	}
	for($i=0;$i<count($wrong);$i++)
	echo utf8_decode($wrong[$i]."<br>");
	?></center>
	</b></div>
	</body>
	</html>
