<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop-up form</title>
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="..\..\css\styleHeader.css">
    <link rel="stylesheet" href="..\..\css\styleFooter.css">
    <script src="js/popup.js" async></script>
</head>
<body>
    <header class="header">
		<a href="/">Главная</a>
		<a href="/?page=games">Игры на JS</a>
		<a href="/?page=sites">Сайты</a>
	</header>
    <div class="wrap">
        <button class="buttonShowPopUp" onclick="showPopUp()">Кликни</button>
        <div class="popUp hidden">
            <div class="popUp__shadow">
                <div class="popUp__box">
                    <img src="img/close.png" alt="close" class="popUp__closeButton" onclick='closePopUp()'>
                    <div class="popUp__offerText">
                        Получите набор файлов<br>для руководителя:
                    </div>
                    <div class="popUp__offer">
                        <div class="popUp__offerIcon">
                            <a href="#"><img src="img/icon_doc.png" alt="icon"></a>
                            <a href="#"><img src="img/icon_xls.png" alt="icon"></a>
                            <a href="#"><img src="img/icon_pdf.png" alt="icon"></a>
                            <a href="#"><img src="img/icon_pdf.png" alt="icon"></a>
                            <a href="#"><img src="img/icon_pdf.png" alt="icon"></a>
                            <a href="#"><img src="img/icon_pdf.png" alt="icon"></a>
                            <a href="#"><img src="img/icon_pdf.png" alt="icon"></a>   
                        </div>
                        <img src="img/book.png" alt="book" class="book">
                        <img src="img/journal.png" alt="journal" class="journal">
                        <img src="img/phone.png" alt="phone" class="phone">
                    </div>
                    <div class="popUp__form">
                        <form action="php/send.php">
                            <label><div class="popUp__textForm">Введите Email для получения файлов:</div>
                                <input class="popUp__itemInput" type="email" name="email" Placeholder="Email" autocomplete="off">
                            </label>
                            <br>
                            <label><div class="popUp__textForm">Введите телефон для подтверждения доступа:</div>
                                <input class="popUp__itemInput" type="tel" name="tel"
                                       pattern="\+7\s?[\(]{0,1}\d{3}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" 
                                       placeholder="+7 (000) 000-00-00"
                                       autocomplete="off" 
                                       title="Пожалуйста, введите телефон в формате: +7(000)000-00-00" 
                                       required="required">
                            </label>
                            <br>
                            <div class="popUp__wrapButtonSubmit">
                                <div class="popUp__buttonSubmitShadow"></div>
                                <button class="popUp__buttonSubmit" type="submit">
                                    <span>Скачать файлы</span>
                                    <img src="img/hand.png" alt="icon">                                
                                </button>
                                <div class="popUp__textUnderForm"><pre>PDF 4,7 MB      DOC 0,8 MB      XLS 1,2 MB</pre></div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>    
    <footer class="footer">
		Copyright, <?php echo date('Y'); ?> &copy; Sotnikov Sergey
	</footer>
</body>
</html>