<?php
/* Smarty version 3.1.30, created on 2016-12-16 16:21:36
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/Home/ami.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585406801fba33_40293758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2370dddbb1b568d5920955e4e4fb5bdbe3793992' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/Home/ami.tpl',
      1 => 1481901694,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_585406801fba33_40293758 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_956446788585406801f9ae0_64017215', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_956446788585406801f9ae0_64017215 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo validation_errors();?>




<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notifications']->value, 'notif');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['notif']->value) {
?>
    <p> <?php echo $_smarty_tpl->tpl_vars['notif']->value;?>
 souhaite vous donnez accès à ses listes <a href="<?php echo base_url();?>
index.php/home/ajouterami?login=<?php echo $_smarty_tpl->tpl_vars['notif']->value;?>
&etat=accepte">Accepter</a> <a href="<?php echo base_url();?>
index.php/home/ajouterami?login=<?php echo $_smarty_tpl->tpl_vars['notif']->value;?>
&etat=refuse">Refuser</a></p>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


<table>
    <tr>
        <th>Ami</th>
        <th>Listes</th>
        <th></th>
    </tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['amis']->value, 'etat', false, 'ami');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ami']->value => $_smarty_tpl->tpl_vars['etat']->value) {
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['ami']->value;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['etat']->value;?>
</td>
        <td><a href="<?php echo base_url();?>
index.php/home/supprimerami?login=<?php echo $_smarty_tpl->tpl_vars['ami']->value;?>
">Supprimer</a></td>
    </tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>

<form method="post" action="<?php echo base_url();?>
index.php/Home/amis">
    <fieldset>
        <legend>Ajouter un ami</legend>
        <p>
            <label for="login">Login de l'ami :</label><input name="ami_login" type="text" required /><br />
        </p>
    </fieldset>
    <p><input type="submit" value="Ajouter un ami" /></p>
</form>

<?php
}
}
/* {/block 'body'} */
}
