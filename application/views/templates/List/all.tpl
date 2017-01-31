{extends file='../layout.tpl'}
{block name=body}

<table>
  <tr>
    <th>Nom</th>
    <th>Date de création</th>
  </tr>
{foreach $lists as $list}
<tr>
  <td>{{$list->name}}</td>
  <td>{{$list->date}}</td>
</tr>
{/foreach}
</table>


{/block}
