let originalXMLHttpRequest = window.XMLHttpRequest;

class XMLHttpRequest {
    constructor() {
        console.log('Code executed by the hacker in XMLHttpRequest constructor');
        this.http = new originalXMLHttpRequest();
    }
    open(method, url, async) {
        console.log('Code executed by the hacker in XMLHttpRequest open');
        this.http.open(method, url, async);
    }
    send() {
        console.log('Code executed by the hacker in XMLHttpRequest send');
        this.http.send();
    }
}