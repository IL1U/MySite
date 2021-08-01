function checkArr (arr, num) {
	for (let i=0;i<arr.length;i++) {
		if (arr[i] == num) return true;
	}
	return false;
}

function arrRandom (arrLength, col) {
	if (arrLength<col) return -1;
	let nums = [];
	for (let i=0;i<col;i++) {
		let num = parseInt(Math.random()*arrLength);
		while (checkArr(nums,num)) {
			num = parseInt(Math.random()*arrLength);
		}
		nums [i] = num;
	}
	return nums;
}

function check (input) {
	if (input == exicise [level][1]) {
		alert ("Ответ верный!!!");
		if (++level == maxlevel) level = 0;
	}
		else alert ("Ответ не верный. \nВаш ответ: "+input+"\nПравильный ответ: "+exicise [level][1]);
	initial ();
	return 0;
}

function start (input) {
	if (document.answer.word0.value == "") document.answer.word0.value = document.answer.word0.value+input
		else document.answer.word0.value = document.answer.word0.value+" "+input;
	counter = 0;
	index = arrRandom (words.length, 6);
	if (++numWord == exicise [level].length) numWord = exicise [level].length-1;
	for (let i=2; i<8; i++) {
		document.answer.elements[i].value = words[index[i-2]];
		if (document.answer.elements[i].value == exicise [level][numWord]) counter++;
		}
	if (counter == 0) document.answer.elements[parseInt(Math.random()*6)+2].value = exicise [level][numWord];
	return 0;
}

function initial () {
	document.answer.text.value = exicise [level][0];
	document.answer.word0.value = "";
	let counter = 0;
	numWord = 2;
	let index = arrRandom (words.length, 6);
	for (let i=2; i<8; i++) {
		document.answer.elements[i].value = words[index[i-2]];
		if (document.answer.elements[i].value == exicise [level][numWord]) counter++;
	};
	if (counter == 0) document.answer.elements[parseInt(Math.random()*6)+2].value = exicise [level][numWord];
}

let words = ["I","you","he","she", "it", "we","they","read","write","look","speak","want","need"];
let exicise = 	[	["машина", "car", "car"],
					["Я читаю","I read", "I", "read"],
					["Ты пишешь", "you write", "you", "write"],
					["Они говорят", "they speak", "they", "speak"],
					["Я могу читать", "I can read", "I", "can", "read"]
				];
let maxlevel = 5;
let level = 0;
let numWord = 2;
initial ();