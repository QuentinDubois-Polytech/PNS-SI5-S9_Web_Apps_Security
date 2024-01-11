(() => {
    const protocol = "http";
    const domain = "host.com";

    const protoToUse = {
        "http": {
            "protocol": "http:",
            "port": "8080",
        },
        "https": {
            "protocol": "https:",
            "port": "4443",
        }
    }[protocol];

    const url = `${protoToUse.protocol}//${domain}:${protoToUse.port}/tp5/ressources/simple.php`;
    window.location.replace(url)
})();

