{extends file='/home/nobilis/coding/server/html/Ptut/application/views/layout.tpl'}
{block name=body}
	<h1> Demande d'Ami </h1>
	<table border="1">
		<th>Name</th>
        {if $data['nbdemande'] > 1}
        {for $i=0 to $data['nbdemande']-1}
			<tr>
			<td>{$data['dem'][$i]['pseudo']}</td>
			<td><a href="index.php?page=accepter_ami&refuse={$data['dem'][$i]['id']}">Supprimer</a></td><td><a href="index.php?page=accepter_ami&accept={$data['dem'][$i]['id']}">Ajouter</a></td>
			</tr>
        {/for}
        {/if}
	</table>
{/block}
