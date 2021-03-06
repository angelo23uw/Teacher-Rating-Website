"use strict";
window.onload = function() {
	$("searchTeacher").onclick = searchTeacher;
}

function searchTeacher() {
	removeElement("main-buttons");
	let form = document.createElement("form");
	let div1 = document.createElement("div");
	let div2 = document.createElement("div");
	let img1 = document.createElement("img");
	let img2 = document.createElement("img");
	let input1 = document.createElement("input");
	let input2 = document.createElement("input");
	let input3 = document.createElement("input");


	form.action = "search.php";

	div1.classList.toggle("input-container");
	div2.classList.toggle("input-container");
	img1.src = "location.jpg";
	img1.alt = "location";
	input1.type = "text";
	input1.name = "school";
	input1.autocomplete= "off";
	input1.placeholder =  "请输入你的学校";
	input1.classList.toggle("input-text");
	input1.id= "showTeacherHint";

	img2.src = "teacher.jpg";
	img2.alt = "teacher";
	input2.type = "text";
	input2.name = "teacher";
	input2.autocomplete= "off";
	input2.placeholder = "请输入你的老师";
	input2.classList.toggle("input-text");
	input3.type = "submit";
	input3.value = "搜索";
	input3.classList.toggle("search-btn");
	div1.appendChild(img1);
	div1.appendChild(input1);
	div2.appendChild(img2);
	div2.appendChild(input2);
	form.appendChild(div1);
	form.appendChild(div2);
	form.appendChild(input3);
	$("center").appendChild(form);
	$("yvm").innerHTML = "SIGN IN";
	$("yvm").classList.toggle("margin-zero");
}

function showTeacherHint(str){
	if(str.length==0){
		document.getElementById('showTeacher').innerHTML= '';
		return;
	}else {
		var xmlhttp= new XMLHttpRequest();
		xmlhttp.onreadystatechange= function(){
			if(this.readyState==4 && this.status==200){
				document.getElementById('showTeacher').innerHTML= this.responseText;
			}
		};
		xmlhttp.open('GET', 'teacherHint.php?str=' + str, true);
		xmlhttp.send();
	}
}

function removeElement(elementId) {
  // Removes an element from the document.
  let element = document. getElementById(elementId);
  element. parentNode. removeChild(element);
}

function $(id) {
  return document.getElementById(id);
}
