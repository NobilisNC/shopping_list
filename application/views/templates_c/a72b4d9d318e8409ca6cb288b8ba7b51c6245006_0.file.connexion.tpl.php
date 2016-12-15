<?php
/* Smarty version 3.1.30, created on 2016-12-15 13:17:18
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/Accueil/connexion.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585289ce0f92b0_47980506',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a72b4d9d318e8409ca6cb288b8ba7b51c6245006' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/Accueil/connexion.tpl',
      1 => 1481803548,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_585289ce0f92b0_47980506 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_988494804585289ce0f8336_94511542', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_988494804585289ce0f8336_94511542 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php if (isset($_smarty_tpl->tpl_vars['not_logged']->value)) {?>
    <p>Vous devez être connecté pour acceder à la page demandée.</p>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['inscription_success']->value === TRUE) {?>
    <p>Votre compte à bien été créé. Vous pouvez desormais vous connecter.</p>
    <?php } elseif ($_smarty_tpl->tpl_vars['inscription_success']->value === FALSE) {?>
    <p>Une erreur est survenue lors de votre inscription.</p>
    <?php }?>

    <?php echo validation_errors();?>

	<form method="post" action="<?php echo base_url();?>
index.php/Accueil/connexion">
		<fieldset>
			<legend>Connexion</legend>
			<p>
				<label for="login">Pseudo :</label><input name="login" type="text" id="pseudo" /><br />
				<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
			</p>
		</fieldset>
		<p><input type="submit" value="Connexion" /></p>
	</form>
	<a href="inscription">Pas encore inscrit ?</a>
<?php
}
}
/* {/block 'body'} */
}
