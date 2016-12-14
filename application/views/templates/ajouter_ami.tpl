{extends file="/home/nobilis/coding/server/html/Ptut/application/views/layout.tpl"}
{block name="title"}Ajouter un ami{/block}
{block name=body}
    <h1>Envoyer une invitation d'amitié</h1>
    <form action="index.php?page=ajouter_ami" method="post">
        <label>Nom : </label><input type="text" name="nom_ami"/>
        <input type="submit" name="envoye" value="Envoyer"/>
    </form>
{/block}
