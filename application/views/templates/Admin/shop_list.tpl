{extends file="../layout.tpl"}
{block name=body}
    <div class="col-left-1 col-10">

        {if $shop_add_success === TRUE}
            <div class="alert alert-green">
                <p>Le magasin a bien été ajouté</p>
            </div>
        {elseif $shop_add_success === FALSE}
            <div class="alert alert-red">
                <p>Le magasin existe déjà dans notre Base de donnée</p>
            </div>
        {/if}

        <h2>Gestion de la liste des magasins</h2>
    {if !empty($shop_list)}
        <table class="table">
            <thead>
                <tr>
                    <td>Nom</td>
                    <td>Lieu</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                {foreach $shop_list as $shop}
                    <tr>
                        <td><span id="shopNameNode{$shop->id}">{$shop->name}</span><span id="shopNameButton{$shop->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                        <td><span id="shopLocationNode{$shop->id}">{$shop->location}</span><span id="shopLocationButton{$shop->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                        <td><a href="{site_url()}/admin/shop/show/{$shop->id}">Voir produits</a></td>
                        <td>
                            <a href="{site_url()}/admin/shop/delete/{{$shop->id}}">
                                <span class="fa fa-trash" aria-hidden="true" data-product_id="{$product->id}" ></span>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p>Aucun magasin</p>
    {/if}
        <form method="post" action="{site_url()}/admin/shop/addShop">
            <label>Nom du magasin : </label><input type="text" name="shop_name">
            <label>Ville : </label><input type="text" name="shop_location">
            <br/><input type="submit" name="confirm_add_shop" value="Ajouter Magasin">
        </form>
    </div>

    <script type="text/javascript" src="{base_url()}static/js/he.js"></script>
    <script type="text/javascript" src="{base_url()}static/js/editText.js"></script>

    <script type="text/javascript">

    window.__URL__ = '{site_url()}/';
    {foreach $shop_list as $shop}
        let shopName{$shop->id} = new editableText(
            {
              button : document.querySelector('#shopNameButton{$shop->id}'),
              node   : document.querySelector('#shopNameNode{$shop->id}'),
              type   : 'text',
              url    : '{site_url()}/admin/shop/{$shop->id}/name'
            }
          );
    {/foreach}

    {foreach $shop_list as $shop}
        let shopLocation{$shop->id} = new editableText(
            {
              button : document.querySelector('#shopLocationButton{$shop->id}'),
              node   : document.querySelector('#shopLocationNode{$shop->id}'),
              type   : 'text',
              url    : '{site_url()}/admin/shop/{$shop->id}/location'
            }
          );
    {/foreach}
    </script>
{/block}
