<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://localhost/css/kickstart.min.css">
		<link rel="stylesheet" type="text/css" href="http://localhost/css/font-awesome-4.7.0/css/font-awesome.min.css">
		<meta charset="utf-8" />
		<title>Gestion de liste de course</title>
	</head>
	<body >
    		<header>
    						{include 'layout/layout_entete.inc.tpl'}
                <div class="navbar">
                {include 'nav/nav.inc.tpl'}
							</div>
        </header>


		<div>
			{block name=body}{/block}
		</div>

		<footer class="">
			<center>
				{include 'layout/layout_pied.inc.tpl'}
			</center>
		</footer>

		<script type="text/javascript" src="http://localhost/css/kickstart.min.js"></script>
	</body>
</html>
