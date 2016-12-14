<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet" type="text/css" href="/home/nobilis/coding/server/html/Ptut/asset/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/home/nobilis/coding/server/html/Ptut/asset/css/style.css">
		<link rel="stylesheet" type="text/css" href="/home/nobilis/coding/server/html/Ptut/asset/css/flat-ui.css">
		<meta charset="utf-8" />
		<title>Gestion de liste de course</title>
	</head>
	<body>
		<header>
			<div class="container">
				{include 'layout/layout_entete.inc.tpl'}
				{include 'nav/nav.inc.tpl'}
			</div>
		</header>

		<div class="container">
			{block name=body}{/block}
		</div>

		<footer>
			<div class="container">
				{include 'layout/layout_pied.inc.tpl'}
			</div>
		</footer>

		<script src="../../asset/js/jquery.min.js"></script>
		<script src="../../asset/js/video.js"></script>
		<script src="../../asset/js/flat-ui.min.js"></script>
		<script src="../../asset/js/application.js"></script>
	</body>
</html>
