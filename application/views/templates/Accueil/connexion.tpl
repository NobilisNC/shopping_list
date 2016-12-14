{extends file="../layout.tpl"}
{block name=body}
	<form method="post" action="index.php/Accueil/connexion">
		<fieldset>
			<legend>Connexion</legend>
			{if isset($data['errPassword']) or isset($data['errLogin'])}
				<p class="has-error">Login ou mot de passe incorrect</p>
			{/if}
			<p>
				<label for="login">Pseudo :</label><input name="login" type="text" id="pseudo" /><br />
				<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
			</p>
		</fieldset>
		<p><input type="submit" value="Connexion" /></p>
	</form>
	<a href="inscription">Pas encore inscrit ?</a>
{/block}
