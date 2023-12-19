<?php 
$name=$_GET["name"]; 
setcookie("Cookie1", $name);
setcookie("Cookie2", $name, time()+1);  /* expire in 1 second*/
?>
<html>
<head>
<title>Cookies</title>
</head>
<body>
Cookie example, hello <?php echo $name;?>
<script>
  alert(document.cookie) ;
</script>
<script>
  alert(document.cookie) ;
</script>
</body>
</html>
