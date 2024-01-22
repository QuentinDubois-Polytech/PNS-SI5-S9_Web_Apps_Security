(() => {
    const protocol = window.location.protocol;
    const port = window.location.port;
    const domain = "host.com";
    const url = `${protocol}//${domain}:${port}/tp5/ressources/simple.php`;
    window.location.replace(url)
})();
