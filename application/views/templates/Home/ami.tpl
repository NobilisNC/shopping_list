{extends file='../layout.tpl'}
{block name=body}


<div class="col-left-1 col-10">
<h1>Amis</h1>

{foreach $notifications as $notif}
  <div class="row">

    <p><span class="label label-blue" style="vertical-align:middle;">
      <i class="fa fa-bell" ></i>Invitation !</span>
      L'utilisateur "<em>{$notif}</em>" souhaite vous donner accès à ses listes
    </p>

      <a href="{site_url()}/home/ajouterami?login={$notif}&etat=accepte">
        <span class="label label-green" style="vertical-align:middle;">
          <i class="fa fa-check" ></i> Accepter
        </span>
      </a>

      <a href="{site_url()}/home/ajouterami?login={$notif}&etat=refuse">
          <span class="label label-red" style="vertical-align:middle;">
          <i class="fa fa-times" ></i> Refuser
        </span>
      </a>

    </div>

{/foreach}

<table class="table">
  <thead>
    <tr>
        <th>Ami</th>
        <th>Listes</th>
        <th></th>
    </tr>
  </thead>
  <tbody>
{foreach $amis as $ami=>$etat}
    <tr>
        <td>{$ami}</td>
        <td>{$etat}</td>
        <td><a href="{site_url()}/home/supprimerami?login={$ami}">
          <span class="label label-red" style="vertical-align:middle;">
          <i class="fa fa-times" ></i> Supprimer
        </span></a></td>
    </tr>
{/foreach}
</tbody>
</table>

{$errors = validation_errors()}
{if $errors}
<div class="alert alert-red">
  {$errors}
</div>
{/if}

<div class="col-4">
<form class="form" method="post" action="{site_url()}/Home/amis">
  <div class="form_group">
      <label for="login">Login de l'ami :</label>
      <input name="ami_login" type="text" required />
  </div>
    <input type="submit" value="Ajouter un ami" />
</form>
</div>
</div>

{/block}
