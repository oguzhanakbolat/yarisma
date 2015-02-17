<?php 
date_default_timezone_set('Europe/Istanbul');
$con = mysqli_connect("localhost", "root", "usbw","oghn_net");
mysqli_set_charset($con,"utf8");
$birKontrol = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 1");
$sayi = mysqli_num_rows($birKontrol);

if($sayi > 0)
	mysqli_query($con,"UPDATE yarisma_soru SET durum = 2  WHERE durum = 1 "); 

$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 2 ORDER BY id DESC LIMIT 1");
$yarismaSoru      = mysqli_fetch_array($yarismaSoruGetir);

if($yarismaSoru["tur"] == 2)
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 1 ORDER BY id");
else
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 0 ORDER BY id");



$soruID = $yarismaSoru["id"];
$dogruCevap = $yarismaSoru["cevap"];

$yarismaCevapGetir1 = mysqli_query($con,"SELECT * FROM yarisma_cevaplar WHERE soru_id = '$soruID' and cevap = '$dogruCevap' ");
$dogruCevapSayisi   = mysqli_num_rows($yarismaCevapGetir1);



if($dogruCevapSayisi == 1)
{
	$puan = 50;
}
else if($dogruCevapSayisi == 2)
{
	$puan = 30;
}
else if($dogruCevapSayisi == 3)
{
	$puan = 20;
}
else
{
	$puan = 10;
}


$yarismaCevapGetir = mysqli_query($con,"SELECT * FROM yarisma_cevaplar WHERE soru_id = '$soruID'");
while($yarismaCevap = mysqli_fetch_array($yarismaCevapGetir))
{
	if($yarismaCevap["cevap"] == $dogruCevap)
	{
		mysqli_query($con,"UPDATE yarisma_cevaplar SET puan = '$puan' WHERE id = '".$yarismaCevap["id"]."' "); 
	}
	else
	{
		mysqli_query($con,"UPDATE yarisma_cevaplar SET puan = 0 WHERE id = '".$yarismaCevap["id"]."' "); 
	}
}


?>

<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8"> 

<style type="text/css">
body{
	margin: 0px;
	font-size: 21px;
	font-family: arial;
}
.yarismaBody{
	background: url("rsm/bg.svg") no-repeat center center fixed #6b6b6b;
	margin: 0px;
}
.cevapYarismacilar{
	float: left;
	margin: 10px;
	background: #fff;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
.cevapYarismacilarH{
	margin: 10px;
}
.cevapYarismacilar span{
	display: block;
	background: #754c24;
	color: #fff;
	height: 50px;
	padding: 5px;
	margin-bottom: 10px;
	text-align: center;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
.cevapYarismacilar img{
	display: block;
	margin-bottom: 10px;
	text-align: center;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	border:1px solid #754c24;
}
.cevapYarismacilar b{
	display: block;
	background: #754c24;
	color: #fff;
	height: 35px;
	width: 35px;
	padding: 10px;
	font-size: 35px;
	margin-bottom: 10px;
	margin-right: 10px;
	float: left;
	text-align: center;
	-webkit-border-top-left-radius: 10px;
	-webkit-border-bottom-left-radius: 10px;
	-moz-border-radius-topleft: 10px;
	-moz-border-radius-bottomleft: 10px;
	border-top-left-radius: 10px;
	border-bottom-left-radius: 10px;
}
.cevapYarismacilar i{
	display: block;
	background: #754c24;
	color: #fff;
	height: 34px;
	padding: 10px;
	font-size: 35px;
	margin-bottom: 10px;
	float: left;
	text-align: center;
	-webkit-border-top-right-radius: 10px;
	-webkit-border-bottom-right-radius: 10px;
	-moz-border-radius-topright: 10px;
	-moz-border-radius-bottomright: 10px;
	border-top-right-radius: 10px;
	border-bottom-right-radius: 10px;
	margin-left: -2010px;
}
.cevaplar{
	height: 200px;
	width: 840px;
	margin: auto;
}

.cevaplar span{
	background: #754c24;
	height: 150px;
	width: 150px;
	color: #fff;
	font-size: 120px;
	float: left;
	display: block;
	text-align: center;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	margin:30px;
}
.sonucPuan{
	background: #754c24;
	color: #fff;
	font-size: 25px;
	height: 25px;
	text-align: center;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	padding: 10px;
	margin-left: -2010px;
}
</style>
<script src="jquery.min.js"></script>
<script src="jquery.animate-colors-min.js"></script>
<script type="text/javascript">

var genislik         = $(window).width();
var yukseklik        = $(window).height();
var siklarGenislik   = genislik;
var grupSayisi       = <?php echo mysqli_num_rows($yarismaGruplariGetir); ?>;
var grupGenislik     = (genislik / grupSayisi) - 20;
var cevpNedir        =  "<?php echo $yarismaSoru["cevap"]; ?>";
window.onload = function()
{	
	$(".yarismaBody").css({"width" : genislik, "height": yukseklik });
	$(".cevapYarismacilar").css({"width" : grupGenislik });
	$(".cevapYarismacilar i").css({"width" : (grupGenislik - 105) });
	$(".cevapYarismacilar img").css({"width" : (grupGenislik - 22), "height" : (grupGenislik - 22) * 1.5 });
	$(".sonucPuan").css({"width" : (grupGenislik - 42)});
}

var grp = 1;
var siklar = 2
document.onkeydown = keyKontrol;
function keyKontrol(key)
{
	var keyKod = key.which;

	if(keyKod == 98 || keyKod == 50)
	{
		document.location = "soru.php"
	}
	else if(keyKod == 101 || keyKod == 53)
	{
		document.location = "soruTekrar.php"
	}
	else if(keyKod == 99 || keyKod == 51)
	{
		document.location = "cevaplar.php"
	}
	else if(keyKod == 100 || keyKod == 52)
	{
		document.location = "cevaplarTekrar.php"
	}


	var ses3 = document.getElementById("sesler3");
	if(keyKod == 39 || keyKod == 34)
	{
		if(siklar == 1)
		{
			$("#cevap" + grp).animate({ marginLeft: "0px" }, 500);
			ses3.play();
		}
		else if(siklar == 2)
		{
			$("#puan" + grp).animate({ marginLeft: "0px" }, 500);
			ses3.play();		
		}
		else if (siklar == 3)
		{
			$("#sonucPuan" + grp).animate({ marginLeft: "0px" }, 500);
			ses3.play();	
		}
		
		if(grp == grupSayisi)
		{
			siklar++;
			grp    = 0;
		}
		else
		{
			grp++;
		}	    
	}

	if(keyKod == 55 || keyKod == 103)
	{
		$('#cevap'+cevpNedir).css({"color": "#fff"})
		$('#cevap'+cevpNedir).animate({backgroundColor: '#f00'},700);
		$('#cevap'+cevpNedir).animate({backgroundColor: '#1E9900'},700);

		var ses5  = document.getElementById("sesler5");
		ses5.play();
	}
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
<audio id="sesler5" controls style="display:none;">
  <source src="audio/cevaplar.mp3" type="audio/mpeg">
</audio>
<div class="yarismaBody">

<div class="cevaplar">
	<span id="cevapA">A</span>
	<span id="cevapB">B</span>
	<span id="cevapC">C</span>
	<span id="cevapD">D</span>
</div>
<div style="clear:both;"></div>

	<?php

	if (!$yarismaGruplariGetir)
	{
	  echo("<br/><br/><br/>Error description: " . mysqli_error($con));
	}
	$i = 1;
	while ($grupIsimler = mysqli_fetch_array($yarismaGruplariGetir))
	{

		$yarismaCevapGetir = mysqli_query($con,"SELECT * FROM yarisma_cevaplar WHERE soru_id = '$soruID' and grup_id = '".$grupIsimler["id"]."'  ");
		$yarismaCevap = mysqli_fetch_array($yarismaCevapGetir);


		$yarismaPuanGetir = mysqli_query($con,"SELECT SUM(puan) as 'grupPuan' FROM yarisma_cevaplar WHERE grup_id = '".$grupIsimler["id"]."'  ");
		$grupPuanlar = mysqli_fetch_array($yarismaPuanGetir);

		echo '
		<div class="cevapYarismacilar">
			<div class="cevapYarismacilarH">
				<span>'.$grupIsimler["ad"].'</span>
				<img src="'.$grupIsimler["resim1"].'">
				<div class="cevapPuan">
					<b id="cevap'.$i.'">'.$yarismaCevap["cevap"].'</b>
					<i id="puan'.$i.'">'.$yarismaCevap["puan"].'</i>
				</div>
				<div style="clear:both;"></div>
				<div id="sonucPuan'.$i.'" class="sonucPuan">'.$grupPuanlar["grupPuan"].'</div>
			</div>
		</div>
		';
		$i++;
	}
	?>
</div>
</body>
</html>