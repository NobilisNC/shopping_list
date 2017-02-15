<?php
/* Smarty version 3.1.30, created on 2017-02-15 07:44:04
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\List\show.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a406c4f36ec0_10059720',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60f54953139f1c4cba01e1360a54257fe120eaff' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\List\\show.tpl',
      1 => 1487142801,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_58a406c4f36ec0_10059720 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_319458a406c4f2e682_39876174', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_319458a406c4f2e682_39876174 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="col-left-1 col-10">
<div class="row">
<h2 id="title"><span id="listName"><?php echo $_smarty_tpl->tpl_vars['list']->value->name;?>
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
      <tr data-product_id="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
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
  <header>Infos</header>
  <main><?php echo $_smarty_tpl->tpl_vars['list']->value->date;?>
</main>
</div>

</div>
</div>


<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/ajax.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
/static/js/fastInput.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
/static/js/productInput.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 type="text/javascript">
var name_bar    = document.getElementById("title");
var list_name   = document.getElementById("listName");
var edit_button = document.getElementById("nameEdit");

var input_name = document.createElement('input');
input_name.defaultValue = list_name.innerHTML;

var send_name_button = document.createElement('span');
send_name_button.className = "fa fa-check";
send_name_button.onclick = sendName;

var cancel_button = document.createElement('span');
cancel_button.className = "fa fa-times";
cancel_button.onclick = resetName;


edit_button.onclick = editName;


function editName() {
    while (name_bar.firstChild) name_bar.removeChild(name_bar.firstChild);
    name_bar.appendChild(input_name);
    name_bar.appendChild(send_name_button);
    name_bar.appendChild(cancel_button);


}

function resetName() {
  while (name_bar.firstChild) name_bar.removeChild(name_bar.firstChild);
  name_bar.appendChild(list_name);
  name_bar.appendChild(edit_button);
}

function sendName() {
  var new_name = input_name.value;

  Ajax.post({
        url : '<?php echo site_url();?>
/home/list/<?php echo $_smarty_tpl->tpl_vars['list']->value->id;?>
/changeName',
        
        data : {'new_name' : input_name.value},
        
        success : changeName
  })


    resetName();
}


function changeName(data) {
  listName.innerHTML = data.name;
}


<?php echo '</script'; ?>
>



<?php
}
}
/* {/block 'body'} */
}
