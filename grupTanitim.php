<?php 
date_default_timezone_set('Europe/Istanbul');
$con = mysqli_connect("localhost", "root", "usbw","oghn_net");
mysqli_set_charset($con,"utf8");

$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 0 ORDER BY id ASC LIMIT 1");
$yarismaSoruTur   = mysqli_fetch_array($yarismaSoruGetir);

if($yarismaSoruTur["tur"] == 1)
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 0 ORDER BY id");
else
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 1 ORDER BY id");
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
.tanitim{
	margin: 15px;
	background: #ddd;
	float: left;
	-webkit-border-radius: 15px;
	-moz-border-radius:    15px;
	border-radius:         15px;
	padding:               10px;
}
.tanitim span{
	height: 28px;
	margin-bottom: 10px;
	text-align: center;
	font-size: 24px;
	padding: 10px;
	color: #fff;
	background: #754c24;
	border:1px solid #754c24;
	display: block;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
.tanitim img{
	color: #fff;
	display: block;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	border: 1px solid #754c24;
	background: #fff;
	padding: 4px;
}
.tanitimH{
	margin-left: -1800px;
	display: block;
}

</style>
<script src="jquery.min.js"></script>
<script src="jquery.animate-colors-min.js"></script>
<script type="text/javascript">

var genislik         = $(window).width();
var yukseklik        = $(window).height();
var grupSayisi       = <?php echo mysqli_num_rows($yarismaGruplariGetir); ?>;
var grupSayisiBol    = Math.ceil(grupSayisi / 2);
var grupGenislik     = (genislik / grupSayisiBol) - 50;
var grupGenislikImg  = grupGenislik - 10;
if(grupSayisi > 6)
var grupYukseklikImg = grupGenislikImg / 4 * 3;
else
var grupYukseklikImg = yukseklik / 3

var grupYukseklik    = grupYukseklikImg + 70;
window.onload = function()
{
	$(".yarismaBody").css({"width" : genislik, "height": yukseklik });
	$(".tanitim").css({"width" : grupGenislik, "height": grupYukseklik });
	$(".tanitimH").css({"width" : grupGenislik, "height": grupYukseklik });
	$(".tanitim img").css({"width" : grupGenislikImg, "height": grupYukseklikImg });
}

var siradaki = 1;
document.onkeydown = keyKontrol;
function keyKontrol(key)
{
	var keyKod = key.which;

	if(keyKod == 66 || keyKod == 220)
	{
		document.location = "soru.php"
	}
	else if(keyKod == 39 || keyKod == 34)
	{
		$("#tanitim"+siradaki+"H").animate({ marginLeft: "0px" }, 500);
		siradaki++;
	}
}

</script>
</head>
<body>


<div class="yarismaBody">
	<section class="sectionClass" id="section1">

	<?php

	if (!$yarismaGruplariGetir)
	{
	  echo("<br/><br/><br/>Error description: " . mysqli_error($con));
	}
	$i = 1;
	while ($grupIsimler = mysqli_fetch_array($yarismaGruplariGetir)) {
		echo '
		<div class="tanitim" id="tanitim'.$i.'">
			<div class="tanitimH" id="tanitim'.$i.'H">
				<span>'.$grupIsimler["ad"].'</span>
				<img src="'.$grupIsimler["resim1"].'">
			</div>
		</div>
		';
		$i++;
	}
	?>

	</section>
</div>
</body>
</html>