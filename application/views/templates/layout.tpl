<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet" type="text/css" href="{base_url()}application/static/css/w3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8" />
		<title>Gestion de liste de course</title>
	</head>
	<body >

    		<header class="w3-container">
    				{include 'layout/layout_entete.inc.tpl'}
                <nav class="w3-navbar w3-center">
                {include 'nav/nav.inc.tpl'}
                </nav>
            </header>

		<div class="w3-container">
			{block name=body}{/block}
		</div>

		<footer class="w3-container">
				{include 'layout/layout_pied.inc.tpl'}
		</footer>

	</body>
</html>
