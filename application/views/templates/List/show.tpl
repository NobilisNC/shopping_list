{extends file='../layout.tpl'}
{block name=body}
<div class="col-left-1 col-10">
<div class="row">
<h2 id="title"><span id="listName">{$list->name}</span> <i id="nameEdit" style="vertical-align:middle; font-size:1em;" class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></h2>
</div>
<div class="row">
<div class="col-9 container">
  <header>Produits</header>
  <main>
    <table id="products" class="table table-blank">
      <tr>
        <th>Produit</th>
        <th>Quantité</th>
      </tr>

    {foreach $products as $product}
      <tr>
        <td><center>{$product->name}
        <a href="{site_url()}/home/list/{$list->id}/deleteProduct/{$product->id}">delete</a></center></td>
        <td><center>{$product->amount}</center></td>
      </tr>
    {/foreach}
    <tr>

        <td>
          <center>
          <div class="tooltip_trigger">
            <input id="productInput" />
              <span id="listProduct" class="tooltip tooltip-left">

              </span>
          </div>
          </center>
        </td>

      <td></td>
    </tr>
  </table>

</main>
</div>
<div class="aside container col-3">
  <header>Infos</header>
  <main>{$list->date}</main>
</div>

</div>
</div>




<script type="text/javascript" src="{base_url()}static/js/ajax.js"></script>
<script type="text/javascript">
  var product_input = document.getElementById("productInput");
  product_input.addEventListener("input", getProducts);
  product_input.addEventListener("keypress", submitProduct);
  var list = document.getElementById("listProduct");

  function getProducts() {
    var name = product_input.value;
    while (list.firstChild) list.removeChild(list.firstChild);

    if(name)
        Ajax.post({
            url : '{site_url()}/product/get/',
            {literal}
            data : {'fragmented_name' : name},
            {/literal}
            success : displayProducts
          });


  }

  function displayProducts(data) {


    data.names.forEach(function(product) {
      var p = document.createElement('p');
      p.innerHTML = product;
      list.appendChild(p);
    });
  }

  function submitProduct(event) {
    const key = event.key;

    if(key == 'Enter')
      Ajax.post({
        url : '{site_url()}/home/list/{$list->id}/addProduct',
        {literal}
        data : {'new_product' : product_input.value},
        {/literal}
        success : addProduct
      })
  }

  function addProduct(data) {
    if(data.status) {
      var list_product = document.getElementById('products');

      var row = list_product.insertRow(list_product.rows.length -1);
      var cell_name = row.insertCell();
      var cell_amount = row.insertCell();
      cell_name.innerHTML = '<center>' + product_input.value + '</center>';
      cell_amount.innerHTML = '<center>' + '1' + '</center>';

      product_input = document.getElementById("productInput");

    } else {
      console.log('An error has occured ...');
    }
  }

</script>
<script type="text/javascript">
var name_bar    = document.getElementById("title");
var list_name   = document.getElementById("listName");
var edit_button = document.getElementById("nameEdit");

var input_name = document.createElement('input');
input_name.defaultValue = list_name.innerHTML;

var send_name_button = document.createElement('i');
send_name_button.className = "fa fa-check";
send_name_button.onclick = sendName;

var cancel_button = document.createElement('i');
cancel_button.className = "fa fa-times";
cancel_button.onclick = resetName;


edit_button.onclick = editName;


function editName() {
    while (name_bar.firstChild) name_bar.removeChild(name_bar.firstChild);
    name_bar.appendChild(input_name);
    name_bar.appendChild(send_name_button);
    name_bar.appendChild(cancel_button);


}

function resetName() {
  while (name_bar.firstChild) name_bar.removeChild(name_bar.firstChild);
  name_bar.appendChild(list_name);
  name_bar.appendChild(edit_button);
}

function sendName() {
  var new_name = input_name.value;

  Ajax.post({
        url : '{site_url()}/home/list/{$list->id}/changeName',
        {literal}
        data : {'new_name' : input_name.value},
        {/literal}
        success : changeName
  })


    resetName();
}


function changeName(data) {
  listName.innerHTML = data.name;
}


</script>

{/block}
