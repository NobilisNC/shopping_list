{extends file='../layout.tpl'}
{block name=body}
<table>
    <tr>
        <th>Login :</th>
        <th>{$login}</th>
    </tr>
    <tr>
        <th>Adresse mail :</th>
        <th>{$mail}</th>
    </tr>
    <tr>
        <th>Nom :</th>
        <th>{$nom}</th>
    </tr>
    <tr>
        <th>Prénom :</th>
        <th>{$prenom}</th>
    </tr>
</table>
{if $smarty.session.password_changed === TRUE }
<p>Mot de passe changé avec succees</p>
{/if}
{validation_errors()}
<form method="post" action="{base_url()}index.php/Home/profil">
    <fieldset>
        <legend>Changer son mot de passe</legend>
        <p>
            <label for="login">Ancien mot de passe :</label><input name="old_password" type="password" required /><br />
            <label for="password">Mot de passe :</label><input name="new_password" type="password" required /> <br/>
            <label for="password">Confirmation du mot de passe :</label><input name="new_password_conf" type="password" required />
        </p>
    </fieldset>
    <p><input type="submit" value="Changer mot de passe" /></p>
</form>
{/block}
