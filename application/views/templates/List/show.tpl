{extends file='../layout.tpl'}
{block name=body}
<div class="col-left-1 col-10">
<div class="row">
<h2 id="title"><span id="listName">{$list->name}</span> <span id="nameEdit" style="vertical-align:middle; font-size:1em;" class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></span></h2>
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
      <tr data-product_id="{$product->id}">
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
  <header>Infos</header>
  <main>{$list->note}</main>
</div>

</div>
</div>


<script type="text/javascript" src="{base_url()}static/js/ajax.js"></script>
<script type="text/javascript" src="{base_url()}/static/js/fastInput.js"></script>
<script type="text/javascript" src="{base_url()}/static/js/productInput.js"></script>


<script type="text/javascript">
var name_bar    = document.getElementById("title");
var list_name   = document.getElementById("listName");
var edit_button = document.getElementById("nameEdit");

var input_name = document.createElement('input');
input_name.defaultValue = list_name.innerHTML;

var send_name_button = document.createElement('span');
send_name_button.className = "fa fa-check";
send_name_button.onclick = sendName;

var cancel_button = document.createElement('span');
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
