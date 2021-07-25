function Ugadayka () {
    alert ("Я загадаю число от 1 до 100,\nа вы попробуйте отгадать.\nЕсли захотите прервать игру просто введите букву вместо числа или нажмите кнопку \"Отмена\"");
    let answer = parseInt(Math.random()*100);
    let userAnswer = 0;
    let user = 1;
    while (!(isNaN(userAnswer))) {
        userAnswer = prompt ("Играет " + user + "-й игрок.\nКакое число я загадал?","");
        if (isNaN(userAnswer) || (userAnswer == null)) {
            alert ("Конец игры!"); 
            userAnswer = NaN;
        }
        userAnswer = +userAnswer;
        if (userAnswer > answer) alert ("Не верно. Мое число меньше.") 
            else if (userAnswer < answer) alert ("Не верно. Мое число больше.")
                else if (userAnswer == answer) {
                    alert ("Вы угадали!\nВ этой игре победил " + user + "-й игрок.");
                    userAnswer = NaN;
                }   
        user = (user == 1) ? 2 : 1;
    }
    return;
}