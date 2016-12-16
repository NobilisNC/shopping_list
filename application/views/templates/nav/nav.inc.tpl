<ul class="nav navbar-nav navbar-left">
	<li><a href="index">Accueil</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
	{if $smarty.session.logged_in === TRUE}
        <li><a href="{base_url()}index.php/home/profil">{$smarty.session.login}</a></li>
        <li><a href="{base_url()}index.php/home/amis">Amis</a></li>
        <li><a href="{base_url()}index.php/home/logout">Se déconnecter</a></li>
	{else}
        <li><a href="{base_url()}index.php/accueil/connexion">Se connecter</a></li>
	{/if}
</ul>
