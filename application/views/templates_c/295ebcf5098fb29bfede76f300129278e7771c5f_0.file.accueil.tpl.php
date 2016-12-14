<?php
/* Smarty version 3.1.30, created on 2016-12-14 15:09:38
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/Accueil/accueil.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585152a2e5d342_59645343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '295ebcf5098fb29bfede76f300129278e7771c5f' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/Accueil/accueil.tpl',
      1 => 1481724576,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_585152a2e5d342_59645343 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1608048405585152a2e5cc40_18450739', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_1608048405585152a2e5cc40_18450739 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ($_smarty_tpl->tpl_vars['inscription_success']->value == TRUE) {?>
<p>Inscription Réussie</p>
<?php } elseif (isset($_smarty_tpl->tpl_vars['inscription_success']->value) && $_smarty_tpl->tpl_vars['inscription_success']->value == FALSE) {?>
<p>Erreur lors de l'inscription. MErci de contacter un administrateur.</p>
<?php }?>

<?php
}
}
/* {/block 'body'} */
}
