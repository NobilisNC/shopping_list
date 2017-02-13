{extends file='../layout.tpl'}
{block name=body}

<div class="col-left-1 col-10">

<table class="table">
  <thead>
  <tr>
    <th>Nom</th>
    <th>Date de création</th>
  </tr>
</thead>
<tbody>
{foreach $lists as $list}
<tr>
  <td><a href="{site_url()}/home/list/show/{{$list->id}}">{{$list->name}}</a></td>
  <td>{{$list->date}}</td>
</tr>
{/foreach}
</tbody>
</table>


</div>
{/block}
