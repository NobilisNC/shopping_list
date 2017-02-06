{extends file='../layout.tpl'}
{block name=body}
<body>
	{$errors = validation_errors()}
	{if $errors}
	<div class="alert alert-red">
		{$errors}
	</div>
	{/if}



	<div class="container col-left-1 col-10">
		<header>Inscription</header>
    <form class="form col-20" name="inscription" method="post" action="{site_url()}/Accueil/inscription">

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="login">Login :</label>
				<input class = "col-10" name="login" type="text" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="nom">Nom  :</label>
				<input class="col-10" name="nom" type="text" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="prenom">Prenom :</label>
				<input class="col-10" name="prenom" type="text" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="mail">Mail :</label>
				<input class="col-10" name="mail" type="email" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="password">Mot De Passe :</label>
				<input class="col-10" name="password" type="password" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="password_conf">Confirmation :</label>
				<input class="col-10" name="password_conf" type="password" value="" size="25" required />
			</div>

			<center>
				<div class="form_group form_group-horizontal">
				<input type="submit" name="valider" value="Valider">
				<input class="button" type="reset" value="Effacer">
				<a class="button" href="connexion">Connexion</a>
				</div>
		</center>

  </form>
</div>


</body>
</html>
{/block}
