<?php 
session_start();
date_default_timezone_set('Europe/Istanbul');
$con = mysqli_connect("localhost", "root", "usbw","oghn_net");
mysqli_set_charset($con,"utf8");

$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 0 ORDER BY id ASC LIMIT 1");
$yarismaSoruTur   = mysqli_fetch_array($yarismaSoruGetir);

if($yarismaSoruTur["tur"] == 1)
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 0 ORDER BY id");
else
	$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE durum = 1 ORDER BY id");


if(isset($_GET["cevap"]))
{

	$yarismaSoruGetir = mysqli_query($con,"SELECT * FROM yarisma_soru WHERE durum = 1 ORDER BY id ASC LIMIT 1");
	$yarismaSoruTur   = mysqli_fetch_array($yarismaSoruGetir);


	$soruId = $yarismaSoruTur["id"];

	$cevapKontrol = mysqli_query($con, "SELECT * FROM yarisma_cevaplar WHERE soru_id = ".$soruId." AND grup_id = ".$_SESSION["grupid"]);
	$sayi = mysqli_num_rows($cevapKontrol);

	if ($sayi > 0) 
	{
		$cevapGuncelle = mysqli_query($con, "UPDATE  yarisma_cevaplar SET grup_cevap = '".$_GET["cevap"]."' WHERE grup_id = ".$_SESSION["grupid"]." AND soru_id = ".$soruId);
	}
	else
	{
		$cevapkaydet = mysqli_query($con, "INSERT  INTO yarisma_cevaplar (soru_id, grup_id, grup_cevap) VALUES (".$soruId.", ".$_SESSION["grupid"].", '".$_GET["cevap"]."')");
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width">
	<style>
	body{
		margin: 0px;
		font-family: arial;
		font-size: 14px;
		background: #ddd
	}
	  #grupAdi {
	  	border: 1px solid #fff;
    	border-radius: 10px;
    	background: #ff4800;
    	width: 90%;
    	margin: 2%;
    	text-align: center;
    	color: #fff;
    	padding: 3%;
    	font-size: 35px;
	  }

	  #soruAlani
	  {
	  	width: 100%;
	  }

	.cevapSecenegi{
		margin: 2%;
		float: left;
		width: 21%;
		background: #00c9d8;
		border-radius: 10px;
		text-align: center;
		padding: 25px 0px 25px 0px;
		color: #fff;
		font-size: 50px;
	}
	 #grupSecimAlani
	  {
	  	margin: 10%;
	  }
	 #grupSecimi
	  {
	  	width: 60%;
	  	height: 20%;
	  	padding: 5%;
	  }
	  #grupSecimButonu
	  {
	  	width: 20%;
	  	height: 20%;
	  	padding: 5%;
	  }
	  #bekleme {
	  	border: 1px solid;
    	border-radius: 25px;
    	background: lightgray;
    	margin-left: auto;
    	margin-right: auto;
    	margin: auto;
    	text-align: center;
	  }
	</style>

	<script src="jquery.min.js"></script>
	<script type="text/javascript">

	function secilenCevap(e)
	{
		document.location = "index.php?cevap=" + e;
	}
	$(document).ready(function(e){


	<?php
	if(isset($_POST["grupSecimButonu"]))
	{
		$_SESSION["grupid"] = $_POST["grupSecimi"];
		echo '
		document.getElementById("grupSecimAlani").style.display = "none";
		document.getElementById("grupAdi").style.display = "block";
		document.getElementById("soruAlani").style.display = "block";';
	}
	elseif(isset($_SESSION["grupid"]))
	{
	echo '	
		document.getElementById("grupSecimAlani").style.display = "none";
		document.getElementById("grupAdi").style.display = "block";
		document.getElementById("soruAlani").style.display = "block";';
	}
	else
	{
	echo '	
		document.getElementById("grupSecimAlani").style.display = "block";
		document.getElementById("grupAdi").style.display = "none";
		document.getElementById("soruAlani").style.display = "none";';
	}

	if(isset($_GET["cevap"]))
	{
		echo '
		document.getElementById("cevap'.$_GET["cevap"].'").style.background = "#d62800";
		';
	}
	?>
	});
	</script>
	</head>
	<body>
		<div id="grupSecimAlani">
			Grup:
			<form method="post" action="">
			<select id="grupSecimi" name="grupSecimi">
			<?php
			while($row = mysqli_fetch_array($yarismaGruplariGetir))
			{
				echo '<option value="'.$row["id"].'">'.$row["ad"].'</option>';
			}
			?>
			</select>
			<input type="submit" name="grupSecimButonu" id="grupSecimButonu" value="Kaydet">
			</form>
		</div>


		<div id="grupAdi" >
			
		<?php
		if(isset($_SESSION["grupid"]))
		{
			$yarismaGruplariGetir = mysqli_query($con,"SELECT * FROM yarisma_grup WHERE id = '".$_SESSION["grupid"]."'  ");
			$row = mysqli_fetch_array($yarismaGruplariGetir);
			echo $row["ad"];
		}
		?>

		</div>
		<div id="soruAlani">
			<div id="cevapA" class="cevapSecenegi" verilencevap="A" onclick="secilenCevap('A')">A</div>
			<div id="cevapB" class="cevapSecenegi" verilencevap="B" onclick="secilenCevap('B')">B</div>
			<div id="cevapC" class="cevapSecenegi" verilencevap="C" onclick="secilenCevap('C')">C</div>
			<div id="cevapD" class="cevapSecenegi" verilencevap="D" onclick="secilenCevap('D')">D</div>
		</div>

	</body>
</html>
