{extends file='../layout.tpl'}
{block name=body}
    <div class="col-left-1 col-10">
        <h2>Mes Magasins</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Lieu</th>
                    <th>aaa</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach $shops as $shop}
                    <tr>
                        <td>{{$shop->name}}</td>
                        <td>{{$shop->location}}</td>
                        <td><a href="{site_url()/admin/shop/show/{$shop->id}}">Voir produits</a></td>
                        <td>
                            <a href="{site_url()}/home/shops/deleteFromMyShops/{{$shop->id}}">
                                <span style="font-size:1.5em;" class="fa fa-trash" aria-hidden="true" data-product_id="{$product->id}" ></span>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        <form method="post" action="{site_url()}/ShopList/addToMyShops">
            Shop name : <input type="text" id="shop_dropdown" name="name_shop_to_add" list="json-datalist" autocomplete="off" onkeyup="searchHint(this.value)">
            <br/><input type="submit" value="Ajouter un magasin">
        </form>
        <datalist id="json-datalist"></datalist>

        <script>
            function removeOptions(object_with_selections)
            {
                while(object_with_selections.firstChild){
                    object_with_selections.removeChild(object_with_selections.firstChild)
                }
            }

            function searchHint(str){
                var dataList = document.getElementById('json-datalist');
                var input = document.getElementById('shop_dropdown');

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var jsonOptions = JSON.parse(xmlhttp.responseText);
                        removeOptions(document.getElementById('json-datalist'));
                        Array.from(jsonOptions).forEach(function(item) {
                            var option = document.createElement('option');
                            option.value = item;
                            dataList.appendChild(option);
                        });
                    }
                };
                xmlhttp.open("GET","{site_url()}/home/shops/get?q="+str,true);
                xmlhttp.send();
            }
        </script>
        <br/>
    </div>
    <br/>
{/block}
