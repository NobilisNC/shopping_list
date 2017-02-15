<?php
/* Smarty version 3.1.30, created on 2017-02-15 07:48:04
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\List\all.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a407b41f97c8_06942391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65c03ccee99fd5b2af32e8bc751a721273e18c25' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\List\\all.tpl',
      1 => 1487144873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_58a407b41f97c8_06942391 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2477858a407b41f7881_70089710', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_2477858a407b41f7881_70089710 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="col-left-1 col-10">
<h2>Mes Listes</h2>

<table class="table">
  <thead>
  <tr>
    <th>Nom</th>
    <th>Date de création</th>
    <th></th>
  </tr>
</thead>
<tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lists']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
<tr>
  <td><a href="<?php echo site_url();?>
/home/list/show/<?php ob_start();
echo $_smarty_tpl->tpl_vars['list']->value->id;
$_prefixVariable1=ob_get_clean();
echo $_prefixVariable1;?>
"><?php ob_start();
echo $_smarty_tpl->tpl_vars['list']->value->name;
$_prefixVariable2=ob_get_clean();
echo $_prefixVariable2;?>
</a></td>
  <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['list']->value->date;
$_prefixVariable3=ob_get_clean();
echo $_prefixVariable3;?>
</td>
  <td><a href="<?php echo site_url();?>
/home/list/delete/<?php echo $_smarty_tpl->tpl_vars['list']->value->id;?>
">
       <span class="fa fa-trash" aria-hidden="true" data-product_id="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" ></span>
      </a>
  </td>
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</tbody>
</table>
<a class="button" href="<?php echo site_url();?>
/home/list/create">Ajouter une liste</a>


</div>
<?php
}
}
/* {/block 'body'} */
}
