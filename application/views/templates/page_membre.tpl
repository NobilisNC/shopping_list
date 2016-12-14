{extends file="/home/nobilis/coding/server/html/Ptut/application/views/layout.tpl"}
{block name="title"}Page Membre{/block}
{block name=body}
    <br/>
    <a class="btn btn-primary" role="button" href="index.php?page=ajouter_ami">Envoyer une invitation d'ami</a>
    <a class="btn btn-primary" role="button" href="index.php?page=page_membre&amp;delete_session=true">Supprimer tous les amis</a>
    <a class="btn btn-primary" role="button" href="index.php?page=accepter_ami">Accepter des invitations</a>
    <br/><br/>
    <table border="2">
        <th>Nom</th><th>Etat</th>
        {foreach $data as $e}
            <tr><td>{$e}</td><td>En attente d'acceptation</td><td><a href="index.php?page=page_membre&amp;delete_user={$e}">Supprimer</a></td></tr>
        {/foreach}
    </table>

{/block}
