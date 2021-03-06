{extends file='../layout.tpl'}
{block name=body}
    <div class="col-left-1 col-10">
        <h2>Gestion des Produits</h2>
        {if !empty($products)}
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Fraicheur</th>
                        <th>Poids</th>
                        <th></th>
                    </tr>

                </thead>
                <tbody>
                    {foreach $products as $product}
                        <tr>
                            <td><span id="productNameNode{$product->id}">{$product->name}</span><span id="productNameButton{$product->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                            <td><span id="productColdnessNode{$product->id}">{$product->coldness}</span><span id="productColdnessButton{$product->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                            <td><span id="productWeightNode{$product->id}">{$product->weight}</span><span id="productWeightButton{$product->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                            <td><a href="{site_url()}/admin/product/deleteProduct/{{$product->id}}">
                                <span class="fa fa-trash" aria-hidden="true" data-product_id="{$product->id}" ></span>
                            </a></td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p>Aucun Produit</p>
        {/if}

                <div class="container">
        <header>Ajouter un Produit</header>


        {{$errors = validation_errors()}}
            {if $errors}
            <div class="alert alert-red">
              {$errors}
            </div>
            {/if}

        <form method="post" action="{site_url()}/admin/product" class="form col-10">
          <div class="form_group form_group-horizontal">
    				<label class="col-2" for="name">Nom du produit :</label>
            <input type="text"  name="name" list="json-datalist">
         </div>

        <div class="form_group form_group-horizontal">
          <label class="col-2" for="exp">Fraicheur (0-5) :</label>
          <select name="exp">
            <option value="0">0 [Non alimentaire]</option>
            <option value="1">1 [Conserves - Condiments]</option>
            <option value="2">2 [Céréales et dérivés]</option>
            <option value="3">3 [Fruit - Légume]</option>
            <option value="4">4 [Garder au frais]</option>
            <option value="5">5 [Surgelé]</option>
          </select>
        </div>

        <div class="form_group form_group-horizontal">
            <label class="col-2" for="exp">Poids :</label>
            <input type="text"  name="weight" list="json-datalist">
        </div>
      <!-- Volume : <input type="text"  name="volume" list="json-datalist"> -->
      <input type="submit" name="addproduct" value="Ajouter un produit">
    </form>
  </div>
</div>
    <script type="text/javascript" src="{base_url()}static/js/he.js"></script>
    <script type="text/javascript" src="{base_url()}static/js/editText.js"></script>

    <script type="text/javascript">

    window.__URL__ = '{site_url()}/';
{foreach $products as $product}
    let productName{$product->id} = new editableText(
        {
          button : document.querySelector('#productNameButton{$product->id}'),
          node   : document.querySelector('#productNameNode{$product->id}'),
          type   : 'text',
          url    : '{site_url()}/admin/product/{$product->id}/title'
        }
      );
{/foreach}

{foreach $products as $product}
    let productColdness{$product->id} = new editableText(
        {
          button : document.querySelector('#productColdnessButton{$product->id}'),
          node   : document.querySelector('#productColdnessNode{$product->id}'),
          type   : 'text',
          url    : '{site_url()}/admin/product/{$product->id}/coldness'
        }
      );
{/foreach}

{foreach $products as $product}
    let productWeight{$product->id} = new editableText(
        {
          button : document.querySelector('#productWeightButton{$product->id}'),
          node   : document.querySelector('#productWeightNode{$product->id}'),
          type   : 'text',
          url    : '{site_url()}/admin/product/{$product->id}/weight'
        }
      );
{/foreach}
    </script>
{/block}
