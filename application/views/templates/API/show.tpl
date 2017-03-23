{extends file='../layout.tpl'}
{block name=body}


<div class="col-left-1 col-10">
<h1>Liste en cours d'utilisation par {$owner}</h1>
<div class="row">
<div class="col-9 container">
  <header>Produits</header>
  <main>
    <table id="productsList" class="table table-blank" data-list_id="{$list_id}">
      <thead>
      <tr>
        <th></th>
        <th>Produit</th>
        <th>Quantité</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    {foreach $products as $product}
      <tr class="product" data-product_id="{$product->id}">
        <td>{if $product->checked}<span class="fa fa-check" aria-hidden="true"></span>{/if}</td>
        <td>{$product->name}</td>
        <td>{$product->amount}</td>
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
<div class="aside container col-3">
  <header>Note</header>
  <main class="max"><span id="note">{nl2br($list->note)}</span></main>
</div>

</div>
</div>

<script type="text/javascript" src="{base_url()}static/js/productInput_Only.js"></script>
{/block}
