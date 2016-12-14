<?php
/* Smarty version 3.1.30, created on 2016-12-14 11:34:17
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585120291af580_64968131',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fdf19c8b3f748dae557ff62dd5bc372b98c9b5a6' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/layout.tpl',
      1 => 1481711508,
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
function content_585120291af580_64968131 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet" type="text/css" href="/home/nobilis/coding/server/html/Ptut/asset/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/home/nobilis/coding/server/html/Ptut/asset/css/style.css">
		<link rel="stylesheet" type="text/css" href="/home/nobilis/coding/server/html/Ptut/asset/css/flat-ui.css">
		<meta charset="utf-8" />
		<title>Gestion de liste de course</title>
	</head>
	<body>
		<header>
			<div class="container">
				<?php $_smarty_tpl->_subTemplateRender("file:layout/layout_entete.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

				<?php $_smarty_tpl->_subTemplateRender("file:nav/nav.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			</div>
		</header>

		<div class="container">
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_714182799585120291ad761_26929976', 'body');
?>

		</div>

		<footer>
			<div class="container">
				<?php $_smarty_tpl->_subTemplateRender("file:layout/layout_pied.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			</div>
		</footer>

		<?php echo '<script'; ?>
 src="../../asset/js/jquery.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="../../asset/js/video.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="../../asset/js/flat-ui.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="../../asset/js/application.js"><?php echo '</script'; ?>
>
	</body>
</html>
<?php }
/* {block 'body'} */
class Block_714182799585120291ad761_26929976 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
