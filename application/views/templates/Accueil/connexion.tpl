{extends file="../layout.tpl"}
{block name=body}

    {if isset($not_logged)}
    <p>Vous devez être connecté pour acceder à la page demandée.</p>
    {/if}

    {if $inscription_success === TRUE}
    <p>Votre compte à bien été créé. Vous pouvez desormais vous connecter.</p>
    {elseif $inscription_success === FALSE}
    <p>Une erreur est survenue lors de votre inscription.</p>
    {/if}

    {validation_errors()}
	<form method="post" action="{base_url()}index.php/Accueil/connexion">
		<fieldset>
			<legend>Connexion</legend>
			<p>
				<label for="login">Pseudo :</label><input name="login" type="text" id="pseudo" /><br />
				<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
			</p>
		</fieldset>
		<p><input type="submit" value="Connexion" /></p>
	</form>
	<a href="inscription">Pas encore inscrit ?</a>
{/block}
