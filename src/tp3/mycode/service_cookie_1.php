<?php
    $cookie_name = "key";
    $cookie_value = "value";
    setcookie($cookie_name, $cookie_value, [
        'expires' => time() + (86400 * 30),
        'path' => '/',
        'samesite' => 'None',
        'secure' => false,
        'httponly' => true,
    ]);
?>

<html>
<head></head>
<body>
    <h1>Cookie set service 1</h1>
</body>
</html>

