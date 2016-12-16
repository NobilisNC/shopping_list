{extends file='../layout.tpl'}
{block name=body}
<body>
	{validation_errors()}

    <form name="inscription" method="post" action="{base_url()}index.php/Accueil/inscription">
        <fieldset>
			<legend>Inscription</legend>
			* Login :  <input name="login" type="text" value="" size="25" required /><br />
			* Nom  : <input name="nom" type="text" value="" size="25" required /><br />
			* Prenom :  <input name="prenom" type="text" value="" size="25" required /><br />
			* Mail : <input name="mail" type="email" value="" size="25" required /><br />
			* Mot De Passe :	<input name="password" type="password" value="" size="25" required /><br />
			* Confirmation : <input name="password_conf" type="password" value="" size="25" required /><br />
			<input type="submit" name="valider" value="Valider">
			<input type="reset" value="Effacer">

			<a href="connexion"><input type="button" value="J'ai déja un compte" /></a> <br />

			* = Champs obligatoires
        </form>
    </fieldset>
</body>
</html>
{/block}
