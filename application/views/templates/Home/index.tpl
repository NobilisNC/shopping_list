{extends file='../layout.tpl'}
{block name=body}
<div class="col-left-1 col-10">
<h2>Mes amis en train de faire leur courses</h2>

{if count($friend_lists) > 0 }
<div class="row">
<table class="table">
  <thead>
  <tr>
    <th>Ami</th>
    <th>Liste</th>
  </tr>
</thead>
<tbody>
{foreach $friend_lists as $list}
<tr>
  <td>{$list->login}</td>
  <td><a href="{site_url()}/useList/show/{$list->id}">{$list->name}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>
{else}
<p>Il n'y a aucun ami en train de faire ses courses</p>

{/if}

</div>



{/block}
