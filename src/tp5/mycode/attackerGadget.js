console.log("attackerGadget.js loaded");

const urlTarget = "http://host.com:8080/tp5/ressources/apiCall";

const request = {
    method: "GET",
};

fetch(urlTarget, request)