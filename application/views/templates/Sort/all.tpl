{extends file='../layout.tpl'}
{block name=body}
<div class="col-left-1 col-10">
<h2>Trie</h2>

<p>Choisir la liste à trie : </p>
<ul>
{foreach $lists as $list}
<li><a href="{site_url()}/home/sort/show/{$list->id}">{{$list->name}}</a><br/></li>
{/foreach}
</ul>
</div>
{/block}
