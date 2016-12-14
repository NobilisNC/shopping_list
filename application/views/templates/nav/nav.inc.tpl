<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="index">Accueil</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			{if !isset($smarty.session.login)}
				<li><a href="connexion">Se connecter</a></li>
			{else}
				<li><a href="#"><span class="fui-user"></span>{$smarty.session.login}</a></li>
				<li><a href="#"><span class="fui-lock"></span> Se déconnecter</a></li>
			{/if}
		</ul>
	</div>
</nav>
