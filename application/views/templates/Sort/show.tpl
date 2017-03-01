{extends file='../layout.tpl'}
{block name=body}
<div class="col-left-1 col-10">
<div class="row">
<h2>Trie</h2>
</div>
<div class="row">
<div class="col-10 container">
<a href="{site_url()}/home/sort/sortWeight/{$list->id}"><button>Tri sur poids</button></a>
<a href="{site_url()}/home/sort/sortColdness/{$list->id}"><button>Tri sur fraicheur</button></a>
</div>
</div>
<div class="row">
<div class="col-9 container">
  <header>{$list->name}</header>
  <main>
    <table id="productsListSort" class="table table-blank">
      <thead>
      <tr>
      	<th>Ordre</th>
        <th>Produit</th>
        <th>Poids</th>
        <th>Fraicheur</th>
      </tr>
    </thead>
    <tbody>
    {$i = 1}
    {foreach $products as $product}
      <tr  class="product" data-product_id="{$product->id}">
      	<td>{$i++}</td>
        <td>{$product->name}</td>
        <td>{$product->weight}</td>
        <td>{$product->coldness}</td>
      </tr>
    {/foreach}
  </tbody>

    <tr>
        <td>
          <div id="productsInput"></div>
        </td>
      <td></td>
    </tr>

  </table>

</main>
</div>
</div>
</div>
{/block}
