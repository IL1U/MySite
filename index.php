<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Личный сайт Сотникова Сергея</title>
	<link rel="stylesheet" href="css\styleBase.css">
	<link rel="stylesheet" href="css\styleHeader.css">
	<?php 
		$choise = $_GET["page"];
		if (!isset($choise))
			echo '<link rel="stylesheet" href="css\styleMain.css">';
		elseif ($choise == 'english')
			echo '<link rel="stylesheet" href="css\styleEnglish.css">
			<script src="ProgJS\english.js" async></script>';
		elseif ($choise == 'games')
			echo '<link rel="stylesheet" href="css\styleGames.css">
			<script src="ProgJS\Zagadki.js" async></script>
			<script src="ProgJS\Ugadayka.js" async></script>
			<script src="ProgJS\SlepVvod.js" async></script>';
		elseif ($choise == 'sites')
			echo '<link rel="stylesheet" href="css\styleSites.css">';
	?>	
	<link rel="stylesheet" href="css\styleFooter.css">
</head>
<body>
	<header class="header">
		<a href="/">Главная</a>
		<a href="/?page=games">Игры на JS</a>
		<a href="/?page=sites">Сайты</a>
	</header>
	<div class="content">
		<?php 
		$choise = $_GET["page"];
		if (!isset($choise))
			require ('templates/main.php');
		elseif ($choise == 'english')
			require ('templates/english.php');
		elseif ($choise == 'games')
			require ('templates/games.php');
		elseif ($choise == 'sites')
			require ('templates/sites.php');		
		?>
	</div>
	<footer class="footer">
		Copyright, <?php echo date('Y'); ?> &copy; Sotnikov Sergey
	</footer>
</body>
</html>