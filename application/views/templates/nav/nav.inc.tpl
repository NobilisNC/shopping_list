<nav>
<ul class="">
	<li><a href="{site_url()}/index">Accueil</a></li>
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
	{if $smarty.session.logged_admin === TRUE}
	<li><a href="{site_url()}/admin/shop_index">
		<i class="fa fa-shopping-basket" aria-hidden="true"></i>
		Gérer les Magasins</a>
	</li>
	<li><a href="{site_url()}/admin/product_index">
		<i class="fa fa-cutlery" aria-hidden="true"></i>
		Gérer les Produits</a>
	</li>
	{/if}
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
