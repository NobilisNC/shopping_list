{extends file='../layout.tpl'}
{block name=body}


<div class="col-left-1 col-10">
  <h2>Profil</h2>

<table class="table table-blank">

    <tr>
        <td >Login :</td>
        <td>{$login}</td>
    </tr>

    <tr>
        <td>Adresse mail :</td>
        <td>{$mail}</td>
    </tr>
    <tr>
        <td>Nom :</td>
        <td>{$nom}</td>
    </tr>
    <tr>
        <td>Prénom :</td>
        <td>{$prenom}</td>
    </tr>
  </table>

  {if $smarty.session.password_changed === TRUE }
    <p>Mot de passe changé avec succees</p>
  {/if}

    {$errors = validation_errors()}
    {if $errors}
    <div class="alert alert-red">
      {$errors}
    </div>
    {/if}

<div class="container">
  <header>Changer son mot de passe</header>
  </main>
<form class="form" metdod="post" action="{base_url()}index.php/Home/profil">

      <div class="form_group">
      <label for="login">Ancien mot de passe :</label>
      <input name="old_password" type="password" required />
      </div>

      <div class="form_group">
      <label for="password">Mot de passe :</label>
      <input name="new_password" type="password" required />
      </div>

      <div class="form_group">
      <label for="password">Confirmation du mot de passe :</label>
      <input name="new_password_conf" type="password" required />
      </div>

      <input type="submit" value="Changer mot de passe" />
</form>
</main>
</div>
</div>
{/block}
