<?php
/* Smarty version 3.1.30, created on 2017-02-15 07:39:17
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a405a54a07c7_78121741',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '18d2bc8e412d1f7f4b7ca26fd9f44222ba12ce44' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\layout.tpl',
      1 => 1487142801,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/layout_entete.inc.tpl' => 1,
    'file:nav/nav.inc.tpl' => 1,
    'file:layout/layout_pied.inc.tpl' => 1,
  ),
),false)) {
function content_58a405a54a07c7_78121741 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>
static/css/kickstart.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>
static/css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>
static/css/my.css">
		<meta charset="utf-8" />
		<title>Gestion de liste de course</title>
	</head>
	<body >
    		<header>
    						<?php $_smarty_tpl->_subTemplateRender("file:layout/layout_entete.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <div class="navbar">
                <?php $_smarty_tpl->_subTemplateRender("file:nav/nav.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

							</div>
        </header>


		<div>
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2517658a405a5497854_52532588', 'body');
?>

		</div>

		<footer class="">
			<center>
				<?php $_smarty_tpl->_subTemplateRender("file:layout/layout_pied.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			</center>
		</footer>

		<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo base_url();?>
static/js/kickstart.min.js"><?php echo '</script'; ?>
>
	</body>
</html>
<?php }
/* {block 'body'} */
class Block_2517658a405a5497854_52532588 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
