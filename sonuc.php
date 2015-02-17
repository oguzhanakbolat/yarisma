<?php 
date_default_timezone_set('Europe/Istanbul');
$con = mysqli_connect("localhost", "root", "usbw","oghn_net");
mysqli_set_charset($con,"utf8");

$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 2 ORDER BY id DESC LIMIT 1");
$yarismaSoru      = mysqli_fetch_array($yarismaSoruGetir);

if($yarismaSoru["tur"] == 2)
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 1 ORDER BY id");
else
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 0 ORDER BY id");

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
}
</style>
<script src="jquery.min.js"></script>
<script src="jquery.animate-colors-min.js"></script>
<script type="text/javascript">

var genislik         = $(window).width();
var yukseklik        = $(window).height();
var siklarGenislik   = genislik;
var grupSayisi       = 3;
var grupGenislik     = (genislik / grupSayisi) - 20;
var cevpNedir        =  "<?php echo $yarismaSoru["cevap"]; ?>";
var siklar           = <?php if( isset($_GET["net"]) ) { echo 2; } else  { echo 1; } ?>;
var net              = <?php if( isset($_GET["net"]) ) { echo $_GET["net"]; } else  { echo 0; } ?>;
var soruNo           = <?php echo $yarismaSoru["soruNo"]; ?>;

window.onload = function()
{
	if(net == 1)
	{
		$(".cevapYarismacilar b").css({"margin-left" : 0 });
	}

	$(".yarismaBody").css({"width" : genislik, "height": yukseklik });
	$(".cevapYarismacilar").css({"width" : grupGenislik });
	$(".cevapYarismacilar i").css({"width" : (grupGenislik - 105) });
	
	if(grupSayisi > 6)
	{
		$(".cevapYarismacilar img").css({"width" : (grupGenislik - 22), "height" : (grupGenislik) * 1.5 });
		$(".cevapYarismacilarH span").css({"font-size": (grupGenislik)*0.13, "height" : 35});
		$(".cevapYarismacilar b").css({"border-radius" : 10, "width" : (grupGenislik - 42), "float" : "none" });
		$(".cevapYarismacilar i").css({"border-radius" : 10, "width" : (grupGenislik - 42), "float" : "none" });
	}
	else if(grupSayisi == 3)		
		$(".cevapYarismacilar img").css({"width" : (grupGenislik - 22), "height" : (grupGenislik - 112) * 1.5 });
	else if(grupSayisi == 2)		
		$(".cevapYarismacilar img").css({"width" : (grupGenislik - 22), "height" : (grupGenislik - 292) * 1.5 });
	else
		$(".cevapYarismacilar img").css({"width" : (grupGenislik - 22), "height" : (grupGenislik - 22) * 1.5 });
	
	$(".sonucPuan").css({"width" : (grupGenislik - 42)});
}

document.onkeydown = keyKontrol;
function keyKontrol(key)
{
	var keyKod = key.which;

	if(keyKod == 39 || keyKod == 34)
	{
		var ses3 = document.getElementById("sesler3");

		if(siklar == 1)
		{
			$(".cevapYarismacilar b").animate({ marginLeft: "0px" }, 500);
			ses3.play();
		}
		else if(siklar == 2)
		{
			$('#cevap'+cevpNedir).css({"color": "#fff"})
			$('#cevap'+cevpNedir).animate({backgroundColor: '#f00'},700);
			$('#cevap'+cevpNedir).animate({backgroundColor: '#1E9900'},700);

			var ses5  = document.getElementById("sesler5");
			ses5.play();
		}
		else if(siklar == 3)
		{
			for(var i = 1; i <= grupSayisi; i++)
			{
				if($("#cevap" + i).html() == cevpNedir)
				{
					$("#cevap" + i).css({"background": "#1E9900"})
					$("#puan" +  i).css({"background": "#1E9900"})
				}
				else
				{
					$("#cevap" + i).css({"background": "#ff0000"})
					$("#puan"  + i).css({"background": "#ff0000"})
				}
			}
			
			ses3.play();		
		}
		else if(siklar == 4)
		{
			$(".cevapYarismacilar i").animate({ marginLeft: "0px" }, 500);
			ses3.play();		
		}
		else if (siklar == 5)
		{
			$(".sonucPuan").animate({ marginLeft: "0px" }, 500);
			ses3.play();	
		}		

		siklar++;
	}
	else if(keyKod == 37 || keyKod == 33)
	{
		document.location = "soruTekrar.php"
	}
	else if(keyKod == 66)
	{
		if(soruNo == 15)
			document.location = "sonuc.php?net=1"
		else
			document.location = "soru.php"
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


<div style="clear:both;"></div>

	<?php




	$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 2 ORDER BY id DESC LIMIT 1");
	$yarismaSoru      = mysqli_fetch_array($yarismaSoruGetir);

	if($yarismaSoru["tur"] == 2)
		$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 1 ORDER BY id");
	else
		$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 0 ORDER BY id");

	$yarismaPuanGetir = mysqli_query($con,"SELECT SUM(puan) as 'grupPuan' FROM yarisma_cevaplar WHERE groupId ORDER BY  grupPuan ASC ");
	while($grupPuanlar = mysqli_fetch_array($yarismaPuanGetir))
	{
		echo $grupPuanlar["grupPuan"].'</br>';
	}

		









		echo '
		<div class="cevapYarismacilar">
			<div class="cevapYarismacilarH">
				<span>'.$grupIsimler["ad"].'</span>
				<img src="'.$grupIsimler["resim1"].'">
				<div style="clear:both;"></div>
				<div id="sonucPuan1" class="sonucPuan">'.$grupPuanlar["grupPuan"].'</div>
			</div>
		</div>
		';

		echo '
		<div class="cevapYarismacilar">
			<div class="cevapYarismacilarH">
				<span>'.$grupIsimler["ad"].'</span>
				<img src="'.$grupIsimler["resim1"].'">
				<div style="clear:both;"></div>
				<div id="sonucPuan2" class="sonucPuan">'.$grupPuanlar["grupPuan"].'</div>
			</div>
		</div>
		';

		echo '
		<div class="cevapYarismacilar">
			<div class="cevapYarismacilarH">
				<span>'.$grupIsimler["ad"].'</span>
				<img src="'.$grupIsimler["resim1"].'">
				<div style="clear:both;"></div>
				<div id="sonucPuan3" class="sonucPuan">'.$grupPuanlar["grupPuan"].'</div>
			</div>
		</div>
		';


	?>
</div>
</body>
</html>