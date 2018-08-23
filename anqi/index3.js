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
	$("reselect-1").onclick = reselectyes;
	$("reselect-2").onclick = reselectno;
	$("textbook-1").onclick = textbookyes;
	$("textbook-2").onclick = textbookno;
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

function reselectyes() {
	changecolor(1,3);
	changerate(1,3);
}
function reselectno() {
	changecolor(2,3);
	changerate(2,3);
}
function textbookyes() {
	changecolor(1,4);
	changerate(1,4);
}
function textbookno() {
	changecolor(2,4);
	changerate(2,4);
}
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
	this.classList.toggle("selected");
	if($("eg").value = "no") {
		$("eg").value = "yes";
	} else {
		$("eg").value = "no";
	}	
}

function respectful() {
	$("respectful").classList.toggle("selected");
	if($("rp").value == "no") {
		$("rp").value = "yes";
	} else {
		$("rp").value = "no";
	}
}

function humorous() {
	$("humorous").classList.toggle("selected");
	if($("hu").value == "no") {
		$("hu").value = "yes";
	} else {
		$("hu").value = "no";
	}
}

function demanding() {
	$("demanding").classList.toggle("selected");
	if($("dm").value == "no") {
		$("dm").value = "yes";
	} else {
		$("dm").value = "no";
	}
}

function inspiring() {
	$("inspiring").classList.toggle("selected");
	if($("is").value == "no") {
		$("is").value = "yes";
	} else {
		$("is").value = "no";
	}
}

function vivid() {
	$("vivid").classList.toggle("selected");
	if($("vi").value == "no") {
		$("vi").value = "yes";
	} else {
		$("vi").value = "no";
	}
}

function feedback() {
	$("feedback").classList.toggle("selected");
	if($("fb").value == "no") {
		$("fb").value = "yes";
	} else {
		$("fb").value = "no";
	}
}

function changecolor(num, row) {
	if(row <= 2) {
		$("num1-" + row).classList.remove("rate-number1");
		$("num2-" + row).classList.remove("rate-number2");
		$("num3-" + row).classList.remove("rate-number3");
		$("num4-" + row).classList.remove("rate-number4");
		$("num5-" + row).classList.remove("rate-number5");
		$("num" + num + "-" + row).classList.toggle("rate-number" + num);
	} else if(row == 3) {
		$("reselect-1").classList.remove("selected");
		$("reselect-2").classList.remove("selected");
		$("reselect-" + num).classList.toggle("selected");
	} else if(row == 4) {
		$("textbook-1").classList.remove("selected");
		$("textbook-2").classList.remove("selected");
		$("textbook-" + num).classList.toggle("selected")
	} else {
		$("attendence-1").classList.remove("selected");
		$("attendence-2").classList.remove("selected");
		$("attendence-" + num).classList.toggle("selected");
	}

}

function changerate(num,row) {
	if(row == 1) {
		$("overallrating").value = num;
	} else if(row == 2) {
		$("hard-degree").value = num;
	} else if(row == 3) {
		if(num == 1) {
			$("rs").value = "yes";
		} else {
			$("rs").value = "no";
		}
	} else if(row == 4) {
		if(num == 1) {
			$("tb").value = "yes";
		} else {
			$("tb").value = "no";
		}
	} else if(row == 5) {
		if(num == 1) {
			$("at").value = "yes";
		} else {
			$("at").value = "no";
		}
	}
}

function $(id) {
  return document.getElementById(id);
}