{extends file='../layout.tpl'}
{block name=body}

<div class="col-left-1 col-10">
<h2>Mes Listes</h2>

<table class="table">
  <thead>
  <tr>
    <th>Nom</th>
    <th>Date de création</th>
    <th></th>
  </tr>
</thead>
<tbody>
{foreach $lists as $list}
<tr>
  <td><a href="{site_url()}/home/list/show/{{$list->id}}">{{$list->name}}</a></td>
  <td>{{$list->date}}</td>
  <td><a href="{site_url()}/home/list/delete/{$list->id}">
       <span class="fa fa-trash" aria-hidden="true" data-product_id="{$product->id}" ></span>
      </a>
  </td>
</tr>
{/foreach}
</tbody>
</table>
<a class="button" href="{site_url()}/home/list/create">Ajouter une liste</a>


</div>
{/block}
