function Test (text, subtext) {
  subtext = subtext.toLowerCase();
  if (text.includes(subtext)) {
    alert ("Молодец! Это правильный ответ!");
    return true;
  } else {
      alert ("Не правильно!");
      return false;
    }
}

function Zagadki () {
  let count = 0;
  let wonders = [
      ["Ква-ква-ква — какая песня!\nЧто быть может интересней,\nЧто быть может веселей?\nА поёт вам…", "лягушка, жаба, квакушка"],
      ["Нашёл пять ягодок в траве\nИ съел одну, осталось…", "четыре, 4"],
      ["Я лаю и кусаю,\nЯ дом ваш охраняю,\nВсегда смотрю во все глаза,\nА как зовут меня?", "собака, собачка, пес, пёс, песик, пёсик"],
      ["Хвост веером, на голове корона.\nНет птицы краше, чем…", "павлин"]
  ];

  for (var i = 0; i < wonders.length; i++) {
    let userAnswer = prompt (wonders[i][0], "Введите сюда ответ");
    if (Test (wonders[i][1], userAnswer)) count++;
  }
  alert ("Правильных ответов: " + count + "\nИгра окончена.");
}