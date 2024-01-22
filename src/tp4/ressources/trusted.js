var url =  "http://host.com:8080/";

// Comment the following line when mitigation is applied
const xmlhttp = new XMLHttpRequest();

function callback(){console.log('response received')}
var call = function () {
           xmlhttp.open('GET',url, true);
	   xmlhttp.onreadystatechange = callback;
           xmlhttp.send(null);
           }
call();
