{extends file="../layout.tpl"}
{block name=body}

<div class="col-left-1 col-10">

    {if isset($not_logged)}
      <div class="alert alert-red">
        <p>Vous devez être connecté pour acceder à la page demandée.</p>
      </div>
    {/if}


    {if $inscription_success === TRUE}
    <div class="alert alert-green">
      <p>Votre compte à bien été créé. Vous pouvez desormais vous connecter.</p>
    </div>
    {elseif $inscription_success === FALSE}
    <div class="alert alert-red">
      <p>Une erreur est survenue lors de votre inscription.</p>
    </div>
    {/if}

{$errors = validation_errors()}
    {if $errors}
    <div class="alert alert-red">
      {$errors}
    </div>
    {/if}

  <center>
  <div class="">
	<form class="form" method="post" action="{site_url()}/Accueil/connexion">

			<legend>Connexion</legend>

        <div class="form_group">
				<label for="login">Pseudo :</label>
        <input name="login" type="text" id="pseudo" />
      </div>
      <div class="form_group">
				<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
			</div>

      <div class="form_group-horizontal form_group">
        <input type="submit" value="Connexion" /></p>
        <a class="button" href="inscription">Pas encore inscrit ?</a>
    </div>


	</form>
</div>
</center>

</div>
{/block}
