<?php 
date_default_timezone_set('Europe/Istanbul');
$con = mysqli_connect("localhost", "root", "usbw","oghn_net");
mysqli_set_charset($con,"utf8");

$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 2 ORDER BY id DESC LIMIT 1");
$yarismaSoru      = mysqli_fetch_array($yarismaSoruGetir);
?>

<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8"> 
<style type="text/css">
body{
	margin: 0px;
	font-size: 25px;
	font-family: arial;
}
.yarismaBody{
	background: url("rsm/bg.svg") no-repeat center center fixed #6b6b6b;
	margin: 0px;
}
.sectionClass{
	margin:0px;
}
.sureBg{
	width: 100px;
	margin: 0px auto 20px auto;
	height: 75px;
	font-weight: bold;
	padding: 35px 0px 10px 0px;
	color : #f00;
	font-size: 42px;
	text-align: center;
	background: url("rsm/srBg.png") no-repeat;
}
.siklar{
	border: 1px solid #f00;
	background: #ddd;
	padding: 10px 20px 10px 20px;
	margin: 20px;
	color:#f00;
	font-size: 25px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	text-align: left;
}
#soru{
	border: 1px solid #f00;
	background: #ddd;
	padding: 20px;
	margin: 20px;
	color:#f00;
	font-size: 25px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	text-align: left;
	line-height: 35px;
}

</style>
<script src="jquery.min.js"></script>
<script src="jquery.animate-colors-min.js"></script>


<script type="text/javascript">

var genislik         = $(window).width();
var yukseklik        = $(window).height();
var siklarGenislik   = genislik - 80;

window.onload = function()
{	
	$(".yarismaBody").css({"width" : genislik, "height": yukseklik });
	$("#soru").css({"width" : siklarGenislik });
	$(".siklar").css({"width" : siklarGenislik });
}

document.onkeydown = keyKontrol;
function keyKontrol(key)
{
	var keyKod = key.which;
	if(keyKod == 39 || keyKod == 34)
	{
		document.location = "cevaplar.php?net=1"
	}
}

</script>
</head>
<body>

<div class="yarismaBody">
	<section class="sectionClass" id="section2">
		<div class="sureBg">0</div>
		<div id="soru" ><b><?php echo $yarismaSoru["soruNo"]; ?>. Soru:</b>  <?php echo $yarismaSoru["soru"]; ?></div>
		<div class="siklar"><b>a)</b> <?php echo $yarismaSoru["a"]; ?></div>
		<div class="siklar"><b>b)</b> <?php echo $yarismaSoru["b"]; ?></div>
		<div class="siklar"><b>c)</b> <?php echo $yarismaSoru["c"]; ?></div>
		<div class="siklar"><b>d)</b> <?php echo $yarismaSoru["d"]; ?></div>
	</section>
</div>
</body>
</html>