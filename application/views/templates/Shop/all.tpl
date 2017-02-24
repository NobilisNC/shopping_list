{extends file='../layout.tpl'}
{block name=body}
    <div class="col-left-1 col-10">
        <h2>Magasins</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Lieu</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach $shops as $shop}
                    <tr>
                        <td>{{$shop->name}}</td>
                        <td>{{$shop->location}}</td>
                        <td><a href="#">Supprimer</a></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        <a class="button" href="{site_url()}/home/shop/create">Ajouter un magasin</a>
    </div>
{/block}
