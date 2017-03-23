<?php
/* Smarty version 3.1.30, created on 2017-03-23 09:02:41
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\List\show.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58d38f3161e2d2_36904462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60f54953139f1c4cba01e1360a54257fe120eaff' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\List\\show.tpl',
      1 => 1488364115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_58d38f3161e2d2_36904462 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2368858d38f3161bd58_61226626', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_2368858d38f3161bd58_61226626 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="col-left-1 col-10">
<div class="row">
<h2><span id="listName"><?php echo $_smarty_tpl->tpl_vars['list']->value->name;?>
</span> <span id="nameEdit" style="vertical-align:middle; font-size:1em;" class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></span></h2>
</div>
<div class="row">
<div class="col-9 container">
  <header>Produits</header>
  <main>
    <table id="productsList" class="table table-blank" data-list_id="<?php echo $_smarty_tpl->tpl_vars['list']->value->id;?>
">
      <thead>
      <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
      <tr  class="product" data-product_id="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['product']->value->name;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['product']->value->amount;?>
</td>
        <td><span class="fa fa-trash deleteProduct" aria-hidden="true" data-product_id="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" ></span></td>
      </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

  </tbody>

    <tr>
        <td>
          <div id="productsInput"></div>
        </td>
      <td></td>
    </tr>

  </table>

</main>
</div>
<div class="aside container col-3">
  <header>Note<span id="noteEdit" style="vertical-align:middle; font-size:1em;" class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></span></header>
  <main class="max"><span id="note"><?php echo nl2br($_smarty_tpl->tpl_vars['list']->value->note);?>
</span></main>
</div>

</div>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/he.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/ajax.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/amountButtons.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/deleteButton.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/productInput.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/editText.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">

window.__URL__ = '<?php echo site_url();?>
/';

let test1 = new editableText(
    {
      button : document.querySelector('#nameEdit'),
      node   : document.querySelector('#listName'),
      type   : 'text',
      url    : '<?php echo site_url();?>
/home/list/<?php echo $_smarty_tpl->tpl_vars['list']->value->id;?>
/title'
    }
  );

  let test2 = new editableText(
      {
        button : document.querySelector('#noteEdit'),
        node   : document.querySelector('#note'),
        type   : 'textarea',
        url    : '<?php echo site_url();?>
/home/list/<?php echo $_smarty_tpl->tpl_vars['list']->value->id;?>
/note'
      }
    );
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'body'} */
}
