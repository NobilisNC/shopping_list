{extends file="../layout.tpl"}
{block name=body}
    <div class="col-left-1 col-10">

        {if $shop_add_success == TRUE}
            <div class="alert alert-green">
                <p>Le magasin a bien été ajouté</p>
            </div>
        {elseif $shop_add_success == FALSE}
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
                </tr>
            </thead>
            <tbody>
                {foreach $shop_list as $shop}
                    <tr>
                        <td>{{$shop->name}}</td>
                        <td>{{$shop->location}}</td>
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
{/block}
