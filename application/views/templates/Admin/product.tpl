{extends file='../layout.tpl'}
{block name=body}
    <div class="col-left-1 col-10">
        <h2>Gestion des Produits</h2>
        {if !empty($products)}
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Fraicheur</th>
                        <th>Poids</th>
                        <th>Volume</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $products as $product}
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->coldness}}</td>
                            <td>{{$product->weight}}</td>
                            <td>{{$product->volume}}</td>
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
        <h2>Ajouter un Produit</h2>

        {{$errors = validation_errors()}}
            {if $errors}
            <div class="alert alert-red">
              {$errors}
            </div>
            {/if}

        <form method="post" action="{site_url()}/admin/product/create">
        Product name : <input type="text"  name="name" list="json-datalist">
        Expiration (0-5) : <select name="exp">
                                  <option value="0">0 [Non alimentaire]</option>
                                  <option value="1">1 [Conserves - Condiments]</option>
                                  <option value="2">2 [Céréales et dérivés]</option>
                                  <option value="3">3 [Fruit - Légume]</option>
                                  <option value="4">4 [Garder au frais]</option>
                                  <option value="5">5 [Surgelé]</option>
                          </select> </br>
      Weight (kg) : <input type="text"  name="weight" list="json-datalist">
      Volume : <input type="text"  name="volume" list="json-datalist">
        <br/><input type="submit" name="addproduct" value="Ajouter un produit">
    </form>
    </div>
{/block}
