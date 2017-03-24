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
      <td></td>
        <td>
          <div class="row">
            <div class="col-6">
              <div id="productsInput"></div>
            </div>
            <div class="col-6">
              <input type="number" id="amount" value="1">
            </div>
        </div>
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

<script type="text/javascript" src="{base_url()}static/js/productInput.js"></script>
<script type="text/javascript">
function add(r) {
    if(r.status == true) {
      let list = document.querySelector('#productsList');
      let row   = list.insertRow(list.rows.length - 1);
      let cell1 = row.insertCell();
      let cell2 = row.insertCell();
      let cell3 = row.insertCell();


      cell2.innerHTML = r.data.product.name;
      cell3.innerHTML = r.data.amount;

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
    action : function(id) {
      let amount_field = document.querySelector("#amount");
      let amount = amount_field.value;

      let x = new XMLHttpRequest();
      x.open('GET', window.__URL__ + 'useList/' + {$list_id} + '/add/'+ id +'/amount/' + amount, true);
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
