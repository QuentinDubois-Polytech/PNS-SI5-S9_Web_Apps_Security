console.log("cc")

// do a fetch to a random adress to see the cookie in the request

//fetch("http://host.com:8080/doesnotexist.html")

// the same with no cors

fetch("http://host.com:8080/doesnotexist.html", {mode: 'no-cors'})