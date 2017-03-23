{extends file="../layout.tpl"}
{block name=body}
<div class="col-left-1 col-10">
    <h2>Administrateurs</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Login</th>
                <th>Mail</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Diminuer privilèges</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
            {foreach $users as $user}
            {if $user->isAdmin == 1  && $user->id != 1}
                <tr>
                    <td>{$user->login}</td>
                    <td>{$user->mail}</td>
                    <td>{$user->name}</td>
                    <td>{$user->fname}</td>
                    <td><a href="{site_url()}/admin/users/rankdown/{{$user->id}}">
                        <span class="fa fa-hand-o-down" aria-hidden="true"></span>
                    </a></td>
                    <td><a href="{site_url()}/admin/users/delete/{{$user->id}}">
                        <span class="fa fa-trash" aria-hidden="true" data-product_id="{$product->id}" ></span>
                    </a></td>
                </tr>
            {/if}
            {/foreach}
        </tbody>
    </table>
    <h2>Utilisateurs</h2>
    {if !empty($users)}
        <table class="table">
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Mail</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Augmenter privilèges</th>
                    <th></th>
                </tr>

            </thead>
            <tbody>
                {foreach $users as $user}
                {if $user->isAdmin == 0}
                    <tr>
                        <td>{$user->login}</td>
                        <td>{$user->mail}</td>
                        <td>{$user->name}</td>
                        <td>{$user->fname}</td>
                        <td><a href="{site_url()}/admin/users/rankup/{{$user->id}}">
                            <span class="fa fa-hand-o-up" aria-hidden="true"></span>
                        </a></td>
                        <td><a href="{site_url()}/admin/users/delete/{{$user->id}}">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </a></td>
                    </tr>
                {/if}
                {/foreach}
            </tbody>
        </table>
    {else}
        <p>Aucun Utilisateur</p>
    {/if}
</div>
{/block}
