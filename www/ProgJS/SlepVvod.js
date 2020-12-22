function getRandomNumber (n) {
	return Math.round(Math.random()*n);
}
function generateText(letters, length) {
	let text = "";
	for (let i = 0; i < length; i++) {
		let n = getRandomNumber (letters.length-1);
		text = text + letters [n];
	}
	return text;
}
function slepVvod () {
	alert ("Вас приветствует программа по обучению слепой печати");
	for (let i = 1; i < 4; i++) {
		while (true) {
			if (i == 1) {var text = generateText (["а", "ф"], 10);}
				else if (i == 2) {text = generateText (["ы", "в"], 10);}
					else {text = generateText (["о", "ж"], 10);}
			alert ("Поставьте мизинец левой руки на букву Ф, безымянный палец — на Ы, средний — на В, указательный — на А. Мизинец правой руки на букву Ж, безымянный палец — на Д, средний — на Л, указательный — на О. Запомните расположение пальцев. Повторяйте за мной");
			let userText = prompt (text);
			if (userText == text) {
				alert ("Все верно.");
				break;
			} else alert ("Вы ошиблись. Попробуйте еще раз.");
		}
		if (i < 3) alert ("Переходим к следующему уровню.");
	}
	alert ("На этом наши занятия закончены.");
}