<?php 

date_default_timezone_set('Europe/Istanbul');
$con = mysqli_connect("localhost", "root", "usbw","oghn_net");

mysqli_set_charset($con,"utf8");

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width">
	<title></title>
	<style type="text/css">
	body{
		margin: 0px;
		font-size: 14px;
		font-family: Arial;
	}
	div{
		margin: 5px;
		border:1px solid #ddd;
		height: 50px;
	}
	b{
		margin-right: 15px;
		width: 100px;
		padding: 10px;
		display: block;
		float: left;
	}
	i{
		border:1px solid #faa;
		padding: 10px;
		background: #f00;
		margin: 5px;
		width: 10px;
		height: 16px;
		float: left;
	}
	span{
		display: block;
		float: both;
	}
	a:link{
		border:1px solid #aaa;
		padding: 10px;
		background: #ddd;
		margin: 5px;
		text-decoration: none;
		float: left;
	}
	a:active{
		border:1px solid #aaa;
		padding: 10px;
		background: #ddd;
		margin: 5px;
		text-decoration: none;
		float: left;
	}
	a:visited{
		border:1px solid #aaa;
		padding: 10px;
		background: #ddd;
		margin: 5px;
		text-decoration: none;
		float: left;
	}
	a:hover{
		border:1px solid #aaa;
		padding: 10px;
		background: #ddd;
		margin: 5px;
		text-decoration: none;
		float: left;
	}
	</style>
</head>
<body>


<?php
if(isset($_GET["grpID"]) )
{
	
	if($_GET["drm"] == 1 )
	{
		$cevapkaydet = mysqli_query($con, "UPDATE yarisma_cevaplar SET yarisma_grup_cevap = '".$_GET["cvp"]."' WHERE yarisma_grup_id = '".$_GET["grpID"]."'  and yarisma_soru_id = '".$_GET["soruID"]."' ");
	}
	else
	{
		$cevapkaydet = mysqli_query($con, "INSERT  INTO yarisma_cevaplar (yarisma_soru_id, yarisma_grup_id, yarisma_grup_cevap) VALUES (".$_GET["soruID"].", ".$_GET["grpID"].", '".$_GET["cvp"]."' )");
	}
}



$grplar        = mysqli_query($con,"SELECT * FROM yarisma_grup ORDER BY id");

while($grup    = mysqli_fetch_array($grplar))
{

	$cvpSon   = mysqli_query($con,"SELECT * FROM yarisma_cevaplar ORDER BY  id DESC");
	$cvpNoNe  = mysqli_fetch_array($cvpSon);

	$cvpSon1  = mysqli_query($con,"SELECT * FROM yarisma_cevaplar WHERE  yarisma_soru_id  = '".$cvpNoNe["yarisma_soru_id"]."' and yarisma_grup_id  = '".$grup["id"]."' ");
	$cvpNoNe1 = mysqli_fetch_array($cvpSon1);
	if($cvpNoNe1["yarisma_grup_cevap"] != "-" || $cvpNoNe1["yarisma_grup_cevap"] == "")
	{
		$ekle = 2;
	}
	else
	{
		$ekle = 1;
	}
	?>

	<div>
		<b><?php echo  $grup["yarisma_grup_adi"]; ?></b>
		<i id="id1"><?php  echo $cvpNoNe1["yarisma_grup_cevap"]; ?></i>
		<a href="kontrol.php?grpID=<?php echo  $grup["id"]; ?>&soruID=<?php echo  $cvpNoNe["yarisma_soru_id"]; ?>&cvp=A&drm=<?php echo $ekle; ?>">A</a> 
		<a href="kontrol.php?grpID=<?php echo  $grup["id"]; ?>&soruID=<?php echo  $cvpNoNe["yarisma_soru_id"]; ?>&cvp=B&drm=<?php echo $ekle; ?>">B</a>
		<a href="kontrol.php?grpID=<?php echo  $grup["id"]; ?>&soruID=<?php echo  $cvpNoNe["yarisma_soru_id"]; ?>&cvp=C&drm=<?php echo $ekle; ?>">C</a>
		<a href="kontrol.php?grpID=<?php echo  $grup["id"]; ?>&soruID=<?php echo  $cvpNoNe["yarisma_soru_id"]; ?>&cvp=D&drm=<?php echo $ekle; ?>">D</a>
		<span></span>
	</div>
	<?php
} ?>
<div>
	<a href="kontrol.php">Yenile</a>

</div>
</body>
</html>