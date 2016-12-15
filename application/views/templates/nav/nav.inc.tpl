<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="index">Accueil</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			{if $smarty.session.logged_in === TRUE}
                <li><a href="{base_url()}index.php/home/profil"><span class="fui-user"></span>{$smarty.session.login}</a></li>
                <li><a href="{base_url()}index.php/home/logout"><span class="fui-lock"></span> Se déconnecter</a></li>
			{else}
                <li><a href="{base_url()}index.php/accueil/connexion">Se connecter</a></li>
			{/if}
		</ul>
	</div>
</nav>
