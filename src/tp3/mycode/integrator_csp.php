<?php
    header("Content-Security-Policy: script-src 'self'");
?>

<html>
<head>
    <title>Trusted page</title>
</head>
<body>
    <h1>
        Trusted page
        
        <div id=secret>
            42
        </div>
    </h1>
    
    <script src="http://evil.com/tp3/mycode/evilGadget_fetch.js"></script>
</body>
</html>