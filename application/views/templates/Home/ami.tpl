{extends file='../layout.tpl'}
{block name=body}
{validation_errors()}



{foreach $notifications as $notif}
    <p> {$notif} souhaite vous donnez accès à ses listes <a href="{base_url()}index.php/home/ajouterami?login={$notif}&etat=accepte">Accepter</a> <a href="{base_url()}index.php/home/ajouterami?login={$notif}&etat=refuse">Refuser</a></p>
{/foreach}

<table>
    <tr>
        <th>Ami</th>
        <th>Listes</th>
        <th></th>
    </tr>
{foreach $amis as $ami=>$state}
    <tr>
        <td>{$ami}</td>
        <td>{$etat}</td>
        <td><a href="{base_url()}index.php/home/supprimerami?login={$ami}">Supprimer</a></td>
    </tr>
{/foreach}
</table>

<form method="post" action="{base_url()}index.php/Home/amis">
    <fieldset>
        <legend>Ajouter un ami</legend>
        <p>
            <label for="login">Login de l'ami :</label><input name="ami_login" type="text" required /><br />
        </p>
    </fieldset>
    <p><input type="submit" value="Ajouter un ami" /></p>
</form>

{/block}
