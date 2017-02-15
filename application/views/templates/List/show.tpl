{extends file='../layout.tpl'}
{block name=body}
<div class="col-left-1 col-10">
<div class="row">
<h2><span id="listName">{$list->name}</span> <span id="nameEdit" style="vertical-align:middle; font-size:1em;" class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></span></h2>
</div>
<div class="row">
<div class="col-9 container">
  <header>Produits</header>
  <main>
    <table id="productsList" class="table table-blank" data-list_id="{$list->id}">
      <thead>
      <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    {foreach $products as $product}
      <tr  class="product" data-product_id="{$product->id}">
        <td>{$product->name}</td>
        <td>{$product->amount}</td>
        <td><span class="fa fa-trash deleteProduct" aria-hidden="true" data-product_id="{$product->id}" ></span></td>
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
  <header>Note<span id="noteEdit" style="vertical-align:middle; font-size:1em;" class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></span></header>
  <main class="max"><span id="note">{nl2br($list->note)}</span></main>
</div>

</div>
</div>


<script type="text/javascript" src="{base_url()}static/js/ajax.js"></script>
<script type="text/javascript" src="{base_url()}/static/js/amountButtons.js"></script>
<script type="text/javascript" src="{base_url()}/static/js/deleteButton.js"></script>
<script type="text/javascript" src="{base_url()}/static/js/productInput.js"></script>

<script type="text/javascript" src="{base_url()}/static/js/editText.js"></script>

<script type="text/javascript">
let test1 = new editableText(
    {
      button : document.querySelector('#nameEdit'),
      node   : document.querySelector('#listName'),
      type   : 'text',
      url    : '{site_url()}/home/list/{$list->id}/title'
    }
  );

  let test2 = new editableText(
      {
        button : document.querySelector('#noteEdit'),
        node   : document.querySelector('#note'),
        type   : 'textarea',
        url    : '{site_url()}/home/list/{$list->id}/note'
      }
    );
</script>

{/block}
