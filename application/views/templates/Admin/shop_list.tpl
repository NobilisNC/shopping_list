{extends file="../layout.tpl"}
{block name=body}
    <div class="col-left-1 col-10">
        <h2>Gestion de la liste des magasins</h2>
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
    </div>
{/block}
