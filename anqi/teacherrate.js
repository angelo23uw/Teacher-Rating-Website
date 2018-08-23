
"use strict";
/* global fetch */

window.onload = function() {
	$("searchButton1").onclick = showForm;
	$("submitButton").onclick = getIntoSubpage;

}

function showForm() {
	$("main").classList.toggle("disappear");
	$("inputForm").classList.toggle("disappear");
}

function getIntoSubpage() {
  $("inputForm").classList.toggle("disappear");
  $("body").classList.toggle("background");
	$("cardcontainer").classList.toggle("cardcontainer");
	$("cardcontainer").classList.toggle("detailPage");
  clearBox("cardcontainer");

  getDetails();
}

function $(id) {
  return document.getElementById(id);
}

function clearBox(elementID)
{
    document.getElementById(elementID).innerHTML = "";
}

function removeElement(elementId) {
  // Removes an element from the document.
  let element = document. getElementById(elementId);
  element. parentNode. removeChild(element);
}


function checkStatus(response) {
 const OK = 200;
 const ERROR = 300;
 if (response.status >= OK && response.status < ERROR) {
   return response.text();
 } else {
   return Promise.reject(new Error(response.status +
                                    ": " + response.statusText));
 }
}

function getDetails() {
	let url = 'https://api.nasa.gov/planetary/apod?api_key=NNKOjkoul8n1CH18TWA9gwngW1s1SmjESPjNoUFo';
  fetch(url)                             // general fetch
    .then(checkStatus)
    .then(handleResponse)
    .catch(console.log);

}

function handleResponse(jsonText) {
	let data = JSON.parse(jsonText);
	var header1 = document.createElement("H1");
	header1.innerHTML = data.date;
	let p = document.createElement("P");
  p.innerHTML = data.explanation;
	let img = document.createElement("IMG");
	img.alt = "picture";
	img.src = data.hdurl;
	img.classList.toggle("fetchIMG");
  // let h1 = document.createElement("H1");
  // let textnode = document.createTextNode(data.copyright);
	// h1.appendChild(textnode);
	// let h2 = document.createElement("H2");
	// textnode = document.createTextNode(data.date);
	// h2.appendChild(textnode);
	// let p = document = createElement("P");
	// textnode = document.createTextNode(data.explanation);
	// p.appendChild(textnode);
	// $("body").appendChild(h1)
	// $("body").appendChild(h2);
	// $("body").appendChild(p);
	$("cardcontainer").appendChild(header1);
	$("cardcontainer").appendChild(p);
	$("cardcontainer").appendChild(img);
}
