<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width">
<script src="jquery.min.js"></script>
<script type="text/javascript">
var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()))
 
if(mobile)
	document.location = "mobile.php";
else
	document.location = "default.php";
</script>
	</head>
	<body>
	</body>
</html>
