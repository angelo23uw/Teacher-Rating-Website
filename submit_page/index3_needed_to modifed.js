"use strict";


window.onload = function() {
	$("num1-1").onclick = rate11;
	$("num2-1").onclick = rate21;
	$("num3-1").onclick = rate31;
	$("num4-1").onclick = rate41;
	$("num5-1").onclick = rate51;
	$("num1-2").onclick = rate12;
	$("num2-2").onclick = rate22;
	$("num3-2").onclick = rate32;
	$("num4-2").onclick = rate42;
	$("num5-2").onclick = rate52;

	$("attendence-1").onclick = attendenceyes;
	$("attendence-2").onclick = attendenceno;

	$("easygoing").onclick = easygoing;
	$("respectful").onclick = respectful;
	$("humorous").onclick = humorous;
	$("demanding").onclick = demanding;
	$("inspiring").onclick = inspiring;
	$("vivid").onclick = vivid;
	$("feedback").onclick = feedback;

}

// this is the overall rating

function rate11() {
	changecolor(1,1);
	changerate(1,1);
}

function rate21() {
	changecolor(2,1);
	changerate(2,1);
}
function rate31() {
	changecolor(3,1);
	changerate(3,1);
}
function rate41() {
	changecolor(4,1);
	changerate(4,1);
}
function rate51() {
	changecolor(5,1);
	changerate(5,1);
}
function rate12() {
	changecolor(1,2);
	changerate(1,2);
}

function rate22() {
	changecolor(2,2);
	changerate(2,2);
}
function rate32() {
	changecolor(3,2);
	changerate(3,2);
}
function rate42() {
	changecolor(4,2);
	changerate(4,2);
}
function rate52() {
	changecolor(5,2);
	changerate(5,2);
}

// this is the yes or no selection

function attendenceyes() {
	changecolor(1,5);
	changerate(1,5);
}
function attendenceno() {
	changecolor(2,5);
	changerate(2,5);
}

//  this is the labels

function easygoing() {
	//put easygoing into class: selected_label
	$("easygoing").classList.toggle("selected-label");
	//give value if easygoing does not have any value after clicking, else remove the value
	if(!$("eg").value) {
		$("eg").value = "平易近人";
	}else{
		$("eg").removeAttribute('value');
	}
	//get the collection with the class:selected_label
	var selected_labels= document.getElementsByClassName('selected-label');
	//get the collection with the class: label
	var labels= document.getElementsByClassName('label');
	//if the selected_labels are up to 3,
	//remove all the other unselected ones hover property and also value
	if(selected_labels.length == 3){
		for(var i=0; i<7; i++){
			if(!labels[i].classList.contains('selected-label')){
				console.log(labels[i]);
				labels[i].classList.replace("label", "unselected-label");
			}
		}
	}
}

function respectful() {

	$("respectful").classList.toggle("selected-label");
	if(!$("rp").value) {
		$("rp").value = "令人尊敬";
	}else{
		$("rp").removeAttribute('value');
	}
	var selected_labels= document.getElementsByClassName('selected-label');
	var labels= document.getElementsByClassName('label');
	if(selected_labels.length == 3){
		for(var i=0; i<7; i++){
			if(!labels[i].classList.contains('selected-label')){
				console.log(labels[i]);
				labels[i].classList.replace("label", "unselected-label");
			}
		}
	}
}

function humorous() {
	$("humorous").classList.toggle("selected-label");
	if(!$("hu").value) {
		$("hu").value = "风趣幽默";
	}else{
		$("hu").removeAttribute('value');
	}
	var selected_labels= document.getElementsByClassName('selected-label');
	var labels= document.getElementsByClassName('label');
	if(selected_labels.length == 3){
		for(var i=0; i<7; i++){
			if(!labels[i].classList.contains('selected-label')){
				console.log(labels[i]);
				labels[i].classList.replace("label", "unselected-label");
			}
		}
	}
}

function demanding() {
	$("demanding").classList.toggle("selected-label");
	if(!$("dm").value) {
		$("dm").value = "作业繁重";
	}else{
		$("dm").removeAttribute('value');
	}
	var selected_labels= document.getElementsByClassName('selected-label');
	var labels= document.getElementsByClassName('label');
	var respectful= document.getElementById('respectful');
	if(!respectful.classList.contains('selected_label')){
		labels[i].classList.replace("label", "unselected-label");
	}
	if(selected_labels.length == 3){
		for(var i=0; i<7; i++){
			if(!labels[i].classList.contains('selected-label')){
				labels[i].classList.replace("label", "unselected-label");
			}
		}

	}
}

function inspiring() {
	$("inspiring").classList.toggle("selected-label");
	if(!$("is").value) {
		$("is").value = "富有灵感";
	}else{
		$("is").removeAttribute('value');
	}
	var selected_labels= document.getElementsByClassName('selected-label');
	var labels= document.getElementsByClassName('label');
	if(selected_labels.length == 3){
		for(var i=0; i<7; i++){
			if(!labels[i].classList.contains('selected-label')){
				console.log(labels[i]);
				labels[i].classList.replace("label", "unselected-label");
			}
		}
	}
}

function vivid() {
	$("vivid").classList.toggle("selected-label");
	if(!$("vi").value) {
		$("vi").value = "讲课生动";
	}else{
		$("vi").removeAttribute('value');
	}
	var selected_labels= document.getElementsByClassName('selected-label');
	var labels= document.getElementsByClassName('label');
	console.log(document.getElementById('vivid'));
	if(selected_labels.length == 3){
		for(var i=0; i<7; i++){
			if(!labels[i].classList.contains('selected-label')){
				labels[i].classList.replace("label", "unselected-label");
			}
		}
	}
}

function feedback() {
	$("feedback").classList.toggle("selected-label");
	if(!$("fb").value) {
		$("fb").value = "反馈及时";
	} else{
		$("fb").removeAttribute('value');
	}
	var selected_labels= document.getElementsByClassName('selected-label');
	var labels= document.getElementsByClassName('label');
	if(selected_labels.length == 3){
		for(var i=0; i<7; i++){
			if(!labels[i].classList.contains('selected-label')){
				console.log(labels[i]);
				labels[i].classList.replace("label", "unselected-label");
			}
		}
	}
}


//function:
//if user uses less than or equal to 3 labels, that would be ok, just 1 or 2 will be displayed;
//if user uses up to 3, whenever he adds another one, the first of three labels will be undisplayed




function changecolor(num, row) {
	if(row <= 2) {
		$("num1-" + row).classList.remove("rate-number1");
		$("num2-" + row).classList.remove("rate-number2");
		$("num3-" + row).classList.remove("rate-number3");
		$("num4-" + row).classList.remove("rate-number4");
		$("num5-" + row).classList.remove("rate-number5");
		$("num" + num + "-" + row).classList.toggle("rate-number" + num);
	} else {
		$("attendence-1").classList.remove("selected-btn");
		$("attendence-2").classList.remove("selected-btn");
		$("attendence-" + num).classList.toggle("selected-btn");
	}
}

function changerate(num,row) {
	if(row == 1) {
		$("overallrating").value = num;
	} else if(row == 5) {
		if(num == 1) {
			$("at").value = "是";
		} else {
			$("at").value = "否";
		}
	} else{
		$("hard-degree").value= num;
	}
}

function $(id) {
  return document.getElementById(id);
}
