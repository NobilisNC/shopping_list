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

<script type="text/javascript" src="{base_url()}static/js/he.js"></script>
<script type="text/javascript" src="{base_url()}static/js/ajax.js"></script>
<script type="text/javascript" src="{base_url()}static/js/amountButtons.js"></script>
<script type="text/javascript" src="{base_url()}static/js/deleteButton.js"></script>
<script type="text/javascript" src="{base_url()}static/js/productInput.js"></script>

<script type="text/javascript" src="{base_url()}static/js/editText.js"></script>

<script type="text/javascript">

console.log();

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

  function add(r) {
      if(r.status == true) {
        let list = document.querySelector('#productsList');
        let row   = list.insertRow(this.list.rows.length - 1);
        let cell1 = row.insertCell();
        let cell2 = row.insertCell();
        let cell3 = row.insertCell();
        let span = document.createElement('span');
        span.dataset.product_id = r.data.product.id;
        span.className = 'fa fa-trash';
        span.addEventListener('click', deleteProduct.delete.bind(this));

        cell1.innerHTML = r.data.product.name;
        cell2.innerHTML = 1;
        cell3.append(span);
        row.dataset.product_id = r.data.product.id;
        row.className = 'product';

        amountButtons.add(row);

        k$.growl({
          text  : 'Le produit : ' + r.data.product.name + ' a été ajouté',
          delay : 2000,
          type  : 'alert-green'
        });
    } else {
      k$.growl({
        text  : 'Erreur lors de l\'ajout du produit',
        delay : 2000,
        type  : 'alert-red'
      });
    }}

  let inputProduct = new productsInput(
    {
      action : function(id_prod) {
        let x = new XMLHttpRequest();
        x.open('GET', window.__URL__ + 'home/list/' + {$list->id} + '/addProduct/'+ id_prod, true);
        x.onload = function() {
          if (x.status === 200) {
              add(JSON.parse(x.responseText));
          }
        };
        x.send();
      }
    });

</script>

{/block}
