<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Личный сайт студента GeekBrains</title>
	<link rel="stylesheet" href="css\style.css"> 
</head>
<body>
	<div class="content">
		<div class="header">
			<a href="#">Главная</a>
			<a href="#" onclick="Zagadki()">Загадки</a>
			<a href="#" onclick="Ugadayka()">Угадайка</a>
			<a href="#" onclick="slepVvod()">Слепой ввод</a>
			<a href="ProgJS\english.html">Учим английский</a>
			<a href="Sites\interior\index.html">Сайт "Interior"</a>
		</div>
		<h1>Личный сайт студента GeekBrains</h1>
		<div class="center">
			<img src="img/photo.jpg">
			<div class="box_text">
				<p><b>Добрый день</b>. Меня зовут <i>Сотников Сергей</i>. Я совсем недавно начал программировать, однако уже написал свой первый сайт.</p>
				<p>В этом мне помог IT-портал <a href="https://geekbrains.ru">GeekBrains</a></p>
				<p>На этом сайте вы сможете сыграть в несколько игр, которые я написал на JavaScript: <br>
					<a href="#" onclick="Zagadki()">Загадки</a>,
					<a href="#" onclick="Ugadayka()">Угадайка</a>,
					<a href="#" onclick="slepVvod()">Слепой ввод</a>,
					<a href="ProgJS\english.html">Учим английский</a>.
				</p>
				<p>А также посмотреть созданные мной сайты.</p>
			</div>
		</div>
	</div>
	<div class="footer">
		Copyright &copy; Sotnikov Sergey
	<div>
<script src="ProgJS\Zagadki.js"></script>
<script src="ProgJS\Ugadayka.js"></script>
<script src="ProgJS\SlepVvod.js"></script>
</body>
</html>