var url =  "http://host.com:8080/";
var xmlhttp = new XMLHttpRequest();

function callback(){console.log('response received')}; 
var call = function () {
           xmlhttp.open('GET',url, true);
	   xmlhttp.onreadystatechange = callback;
           xmlhttp.send(null);
           }
call();
