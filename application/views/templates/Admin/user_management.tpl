{extends file="../layout.tpl"}
{block name=body}
<div class="col-left-1 col-10">
    <h1>Utilisateurs</h1>
    {if !empty($users)}
        <table class="table">
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Mail</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th></th>
                </tr>

            </thead>
            <tbody>
                {foreach $users as $user}
                {if $user->isAdmin == 0}
                    <tr>
                        <td><span id="userLoginNode{$user->id}">{$user->login}</span><span id="userLoginButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                        <td><span id="userMailNode{$user->id}">{$user->mail}</span><span id="userMailButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                        <td><span id="userNameNode{$user->id}">{$user->name}</span><span id="userNameButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                        <td><span id="userFnameNode{$user->id}">{$user->fname}</span><span id="userFnameButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                        <td><a href="{site_url()}/admin/product/deleteProduct/{{$product->id}}">
                            <span class="fa fa-trash" aria-hidden="true" data-product_id="{$product->id}" ></span>
                        </a></td>
                    </tr>
                {/if}
                {/foreach}
            </tbody>
        </table>
    {else}
        <p>Aucun Utilisateur</p>
    {/if}
    <h1>Administrateurs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Login</th>
                <th>Mail</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
            {foreach $users as $user}
            {if $user->isAdmin == 1}
                <tr>
                    <td><span id="userLoginNode{$user->id}">{$user->login}</span><span id="userLoginButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                    <td><span id="userMailNode{$user->id}">{$user->mail}</span><span id="userMailButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                    <td><span id="userNameNode{$user->id}">{$user->name}</span><span id="userNameButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                    <td><span id="userFnameNode{$user->id}">{$user->fname}</span><span id="userFnameButton{$user->id}" class="fa fa-pencil-square-o fa-fw"></span></td>
                    <td><a href="{site_url()}/admin/product/deleteProduct/{{$product->id}}">
                        <span class="fa fa-trash" aria-hidden="true" data-product_id="{$product->id}" ></span>
                    </a></td>
                </tr>
            {/if}
            {/foreach}
        </tbody>
    </table>
</div>

<script type="text/javascript" src="{base_url()}static/js/he.js"></script>
<script type="text/javascript" src="{base_url()}static/js/editText.js"></script>

<script type="text/javascript">

window.__URL__ = '{site_url()}/';
{foreach $users as $user}
let userLoginModifier{$user->id} = new editableText(
    {
      button : document.querySelector('#userLoginButton{$user->id}'),
      node   : document.querySelector('#userLoginNode{$user->id}'),
      type   : 'text',
      url    : '{site_url()}/admin/users/{$user->id}/login'
    }
  );
{/foreach}

{foreach $users as $user}
let userMailModifier{$user->id} = new editableText(
    {
      button : document.querySelector('#userMailButton{$user->id}'),
      node   : document.querySelector('#userMailNode{$user->id}'),
      type   : 'text',
      url    : '{site_url()}/admin/users/{$user->id}/mail'
    }
  );
{/foreach}

{foreach $users as $user}
let userNameModifier{$user->id} = new editableText(
    {
      button : document.querySelector('#userNameButton{$user->id}'),
      node   : document.querySelector('#userNameNode{$user->id}'),
      type   : 'text',
      url    : '{site_url()}/admin/users/{$user->id}/mail'
    }
  );
{/foreach}

{foreach $users as $user}
let userFnameModifier{$user->id} = new editableText(
    {
      button : document.querySelector('#userFnameButton{$user->id}'),
      node   : document.querySelector('#userFnameNode{$user->id}'),
      type   : 'text',
      url    : '{site_url()}/admin/users/{$user->id}/mail'
    }
  );
{/foreach}
</script>

{/block}
