<?php
/* Smarty version 3.1.30, created on 2017-02-15 07:41:25
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\Home\ami.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a40625854d10_52043090',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a53e4cb03672c7001b436f286906640871ca846f' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\Home\\ami.tpl',
      1 => 1487142801,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_58a40625854d10_52043090 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2617058a40625851240_18366541', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_2617058a40625851240_18366541 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<div class="col-left-1 col-10">
<h1>Amis</h1>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notifications']->value, 'notif');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['notif']->value) {
?>
  <div class="row">

    <p><span class="label label-blue" style="vertical-align:middle;">
      <i class="fa fa-bell" ></i>Invitation !</span>
      L'utilisateur "<em><?php echo $_smarty_tpl->tpl_vars['notif']->value;?>
</em>" souhaite vous donnez accès à ses listes
    </p>

      <a href="<?php echo site_url();?>
/home/ajouterami?login=<?php echo $_smarty_tpl->tpl_vars['notif']->value;?>
&etat=accepte">
        <span class="label label-green" style="vertical-align:middle;">
          <i class="fa fa-check" ></i> Accepter
        </span>
      </a>

      <a href="<?php echo site_url();?>
/home/ajouterami?login=<?php echo $_smarty_tpl->tpl_vars['notif']->value;?>
&etat=refuse">
          <span class="label label-red" style="vertical-align:middle;">
          <i class="fa fa-times" ></i> Refuser
        </span>
      </a>

    </div>

<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


<table class="table">
  <thead>
    <tr>
        <th>Ami</th>
        <th>Listes</th>
        <th></th>
    </tr>
  </thead>
  <tbody>
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
        <td><a href="<?php echo site_url();?>
/home/supprimerami?login=<?php echo $_smarty_tpl->tpl_vars['ami']->value;?>
">
          <span class="label label-red" style="vertical-align:middle;">
          <i class="fa fa-times" ></i> Supprimer
        </span></a></td>
    </tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</tbody>
</table>

<div class="col-4">
<form class="form" method="post" action="<?php echo site_url();?>
/Home/amis">
  <div class="form_group">
      <label for="login">Login de l'ami :</label>
      <input name="ami_login" type="text" required />
  </div>
    <input type="submit" value="Ajouter un ami" />
</form>
</div>
</div>

<?php
}
}
/* {/block 'body'} */
}
