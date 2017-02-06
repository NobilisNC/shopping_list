<nav>
<ul class="">
	<li><a href="index">Accueil</a></li>
</ul>
<ul>
	{if $smarty.session.logged_in === TRUE}

				<li><a href="{site_url()}/home/list">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							Mes listes
						</a>
				</li>
        <li><a href="{site_url()}/home/amis">
					<i class="fa fa-user-plus" aria-hidden="true"></i>
					Amis</a>
				</li>
				<li><a href="{site_url()}/home/profil">{$smarty.session.login}</a></li>
        <li><a href="{site_url()}/home/logout">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					Se déconnecter</a>
				</li>
	{else}
        <li><a href="{site_url()}/accueil/connexion">Se connecter</a></li>
	{/if}
</ul>
</nav>
