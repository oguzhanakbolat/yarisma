<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8"> 
<style type="text/css">
body{
	margin: 0px;
	background: #e20000;
	font-size: 24px;
	font-family: arial;
	color : #fff;
}
.center{
	width: 800px;
	height: 500px;
	margin: auto;
}
.tel{
	background: url(rsm/tel.png) no-repeat;
	padding-left: 150px;
	height: 100px;
	margin-top: 60px;
	margin-bottom: 130px;
}
.tel span{
	display: block;
	padding: 13px;
	border:5px solid #fff;
	font-size: 50px;
	height: 60px;
	font-weight: bold;
}
.detay{
	width: 800px;
	height: 300px;
}
.detay span{
	display: block;
	font-size: 80px;
	height: 60px;
	font-weight: bold;
	text-align: center;
	color: #300;
}
.serit{
	background: #e9282b;
	height: 40px;
}
.serit div{
	width: 800px;
	height: 40px;
	margin: auto;
}
a {
	width: 150px;
	margin-left: 10px;
	height: 20px;
	font-size: 16px;
	background: #870604;
	text-decoration: none;
	float: right;
	display: block;
	margin-top: 5px;
	text-align: center;
	color:#f9918c;
	padding:5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
select{
	width: 200px;
	height: 30px;
	font-size: 14px;
	background: #870604;
	text-decoration: none;
	float: left;
	display: block;
	margin-top: 5px;
	text-align: center;
	color:#f9918c;
	padding:5px;
	border:0px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	outline: none;
}
</style>
<script type="text/javascript">

</script>
</head>
<body>
<div class="center">
	<div class="tel">
		<span><?php echo getHostByName(getHostName()); ?>:8080</span>
	</div>
	<div class="detay">
		<span>- İslami Şahsiyet -</span>
	</div>
</div>
<div class="serit">
	<div>
		<a href="grupTanitim.php">Başla</a>
		<a href="yarismacilar.php">Yarışmacılar</a>
		<a href="sorular.php">Sorular</a>
		<select>
			<option>İslami Şahsiyet</option>
			<option>İktisadi Nizamı</option>
			<option>Sorularla hilafet ve Halife</option>
		</select>
	</div>
</div>
</body>
</html>