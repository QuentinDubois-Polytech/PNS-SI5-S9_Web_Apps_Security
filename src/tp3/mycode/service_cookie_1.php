<?php
    $cookie_name = "key";
    $cookie_value = "value";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>

<html>
<head></head>
<body>
    <h1>Cookie set service 1</h1>
</body>
</html>

