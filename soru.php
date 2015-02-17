<?php 
date_default_timezone_set('Europe/Istanbul');
$con = mysqli_connect("localhost", "root", "usbw","oghn_net");
mysqli_set_charset($con,"utf8");
$birKontrol = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 1");
$sayi = mysqli_num_rows($birKontrol);

if($sayi > 0)
	$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 1 ORDER BY id ASC LIMIT 1");
else
	$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 0 ORDER BY id ASC LIMIT 1");

$yarismaSoru      = mysqli_fetch_array($yarismaSoruGetir);
mysqli_query($con,"UPDATE yarisma_soru SET durum = 1  WHERE id = " . $yarismaSoru["id"]);

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
	margin-left: -2000px;
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
	margin-left: -2000px;
}
</style>
<script src="jquery.min.js"></script>
<script src="jquery.animate-colors-min.js"></script>
<script type="text/javascript">
<?php
echo '
	var tur  = "'.$yarismaSoru["tur"].'";
	var soru = "'.$yarismaSoru["id"] .' - ' . $yarismaSoru["puan"].'  - ' . $yarismaSoru["soru"].'";
	var srNo = "'.$yarismaSoru["soruNo"].'";
	var sikA = "'.$yarismaSoru["a"].'";
	var sikB = "'.$yarismaSoru["b"].'";
	var sikC = "'.$yarismaSoru["c"].'";
	var sikD = "'.$yarismaSoru["d"].'";';
?>

var genislik         = $(window).width();
var yukseklik        = $(window).height();
var siklarGenislik   = genislik - 80;

window.onload = function()
{	
	$(".yarismaBody").css({"width" : genislik, "height": yukseklik });
	$("#soru").css({"width" : siklarGenislik });
	$(".siklar").css({"width" : siklarGenislik });
	$("#soru").html("<b>" + srNo + ". SORU )</b> " + soru);
	$("#sikA").html("<b>A)</b> " + sikA);
	$("#sikB").html("<b>B)</b> " + sikB);
	$("#sikC").html("<b>C)</b> " + sikC);
	$("#sikD").html("<b>D)</b> " + sikD);

	if(tur == 1)
		$(".sureBg").html(120);
	else
		$(".sureBg").html(90);

}
var baslaGong = 0;
var soruSik = 1;
document.onkeydown = keyKontrol;
function keyKontrol(key)
{
	var keyKod = key.which;
	var ses2 = document.getElementById("sesler2");
	var ses3 = document.getElementById("sesler3");
	var ses4 = document.getElementById("sesler4");
	
	if(keyKod == 39 || keyKod == 34)
	{
		if(soruSik == 1)
		{
			$("#soru").animate({ marginLeft: "20px" }, 500);
			ses3.play();
	    }
	    else if(soruSik == 2)
	    {
			$("#sikA").animate({ marginLeft: "20px" }, 500);
			ses3.play();
	    }
	    else if(soruSik == 3)
	    {
	    	$("#sikB").animate({ marginLeft: "20px" }, 500);
			ses3.play();
	    }
	    else if(soruSik == 4)
	    {
	    	$("#sikC").animate({ marginLeft: "20px" }, 500);
			ses3.play();
	    }
	    else if(soruSik == 5)
	    {
	    	$("#sikD").animate({ marginLeft: "20px" }, 500);
			ses3.play();
	    }	
	    else if(baslaGong == 0)
	    {
	    	ses4.play();
	    	showTime();
	    	baslaGong = 1;
	    }	
	}
	else if(keyKod == 66)
	{
		ses2.play();		
		setTimeout('git()', 1000);
	}

	soruSik++;
}

var sureGenislik = 0;
var sureDurum    = 0;

function showTime()
{
	var kalanSure = parseInt($(".sureBg").html());

	var ses1 = document.getElementById("sesler1");
	var ses2 = document.getElementById("sesler2");
	
	kalanSure--;
	$(".sureBg").html(kalanSure);

	if(kalanSure < 1)
	{
		ses2.play();		
		setTimeout('git()', 1000);
	}
	else if(kalanSure < 11)
	{
		if(sureDurum == 0)
		{
			ses1.play();
			sureDurum = 1;
		}
		setTimeout('showTime()', 1000);
	}
	else
	{
		setTimeout('showTime()', 1000);
	}
}

function git()
{
	setTimeout(document.location = "cevaplar.php", 1000);
}

</script>
</head>
<body>

<audio id="sesler1" controls style="display:none;">
  <source src="audio/beep1.mp3" type="audio/mpeg">
</audio>
<audio id="sesler2" controls style="display:none;">
  <source src="audio/sureBitti.mp3" type="audio/mpeg">
</audio>
<audio id="sesler3" controls style="display:none;">
  <source src="audio/sorular.mp3" type="audio/mpeg">
</audio>
<audio id="sesler4" controls style="display:none;">
  <source src="audio/gong.mp3" type="audio/mpeg">
</audio>

<div class="yarismaBody">
	<section class="sectionClass" id="section2">
		<div class="sureBg">120</div>
		<div id="soru" ></div>
		<div id="sikA" class="siklar"></div>
		<div id="sikB" class="siklar"></div>
		<div id="sikC" class="siklar"></div>
		<div id="sikD" class="siklar"></div>
	</section>
</div>
</body>
</html>