<?php
    $msg = "Email клиента: " . $_GET['email'] . "\nТелефон клиента: " . $_GET['tel'];
    echo $msg;
    $headers = 'From: webmaster@testtasksalesgenerator.ru' . "\r\n" .
    'Reply-To: webmaster@testtasksalesgenerator.ru' . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . 'Content-type: text/plane; charset=UTF-8';
    $res = mail('iliu@yandex.ru', 'Данные из формы (тест)', $msg, $headers);
    if ($res) echo "<br>Почтовое отправление принято к доставке";
    else echo "<br>Почтовое отправление отклонено";
?>