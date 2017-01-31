{extends file='../layout.tpl'}
{block name=body}

<table>
  <tr>
    <th>Nom</th>
    <th>Date de création</th>
  </tr>
{foreach $lists as $list}
<tr>
  <td><a href="{{base_url()}}index.php/home/list/show/{{$list->id}}">{{$list->name}}</a></td>
  <td>{{$list->date}}</td>
</tr>
{/foreach}
</table>


{/block}
