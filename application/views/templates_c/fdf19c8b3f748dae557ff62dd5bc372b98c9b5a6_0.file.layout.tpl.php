<?php
/* Smarty version 3.1.30, created on 2016-12-16 14:10:03
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5853e7ab9cd024_58204333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fdf19c8b3f748dae557ff62dd5bc372b98c9b5a6' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/layout.tpl',
      1 => 1481883455,
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
function content_5853e7ab9cd024_58204333 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>
application/static/css/w3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8" />
		<title>Gestion de liste de course</title>
	</head>
	<body >

    		<header class="w3-container">
    				<?php $_smarty_tpl->_subTemplateRender("file:layout/layout_entete.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <nav class="w3-navbar w3-center">
                <?php $_smarty_tpl->_subTemplateRender("file:nav/nav.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                </nav>
            </header>

		<div class="w3-container">
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18027065745853e7ab9cad01_95118910', 'body');
?>

		</div>

		<footer class="w3-container">
				<?php $_smarty_tpl->_subTemplateRender("file:layout/layout_pied.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		</footer>

	</body>
</html>
<?php }
/* {block 'body'} */
class Block_18027065745853e7ab9cad01_95118910 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
