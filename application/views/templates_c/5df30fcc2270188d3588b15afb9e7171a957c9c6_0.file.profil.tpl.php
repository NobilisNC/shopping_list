<?php
/* Smarty version 3.1.30, created on 2016-12-15 13:09:53
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/Home/profil.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58528811bc6fe6_60894485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5df30fcc2270188d3588b15afb9e7171a957c9c6' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/Home/profil.tpl',
      1 => 1481803542,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_58528811bc6fe6_60894485 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_108146825658528811bc55c5_37814917', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_108146825658528811bc55c5_37814917 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<table>
    <tr>
        <th>Login :</th>
        <th><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</th>
    </tr>
    <tr>
        <th>Adresse mail :</th>
        <th><?php echo $_smarty_tpl->tpl_vars['mail']->value;?>
</th>
    </tr>
    <tr>
        <th>Nom :</th>
        <th><?php echo $_smarty_tpl->tpl_vars['nom']->value;?>
</th>
    </tr>
    <tr>
        <th>Prénom :</th>
        <th><?php echo $_smarty_tpl->tpl_vars['prenom']->value;?>
</th>
    </tr>
</table>
<?php if ($_SESSION['password_changed'] === TRUE) {?>
<p>Mot de passe changé avec succees</p>
<?php }
echo validation_errors();?>

<form method="post" action="<?php echo base_url();?>
index.php/Home/profil">
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
<?php
}
}
/* {/block 'body'} */
}
