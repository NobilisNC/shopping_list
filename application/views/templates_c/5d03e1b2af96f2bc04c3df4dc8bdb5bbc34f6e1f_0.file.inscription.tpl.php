<?php
/* Smarty version 3.1.30, created on 2017-02-15 07:40:20
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\Accueil\inscription.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a405e4559d14_61175358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d03e1b2af96f2bc04c3df4dc8bdb5bbc34f6e1f' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\Accueil\\inscription.tpl',
      1 => 1487142801,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_58a405e4559d14_61175358 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1193258a405e4554ce0_66686604', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_1193258a405e4554ce0_66686604 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<body>
	<?php $_smarty_tpl->_assignInScope('errors', validation_errors());
?>
	<?php if ($_smarty_tpl->tpl_vars['errors']->value) {?>
	<div class="alert alert-red">
		<?php echo $_smarty_tpl->tpl_vars['errors']->value;?>

	</div>
	<?php }?>



	<div class="container col-left-1 col-10">
		<header>Inscription</header>
    <form class="form col-20" name="inscription" method="post" action="<?php echo site_url();?>
/Accueil/inscription">

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="login">Login :</label>
				<input class = "col-10" name="login" type="text" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="nom">Nom  :</label>
				<input class="col-10" name="nom" type="text" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="prenom">Prenom :</label>
				<input class="col-10" name="prenom" type="text" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="mail">Mail :</label>
				<input class="col-10" name="mail" type="email" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="password">Mot De Passe :</label>
				<input class="col-10" name="password" type="password" value="" size="25" required />
			</div>

			<div class="form_group form_group-horizontal">
				<label class="col-2" for="password_conf">Confirmation :</label>
				<input class="col-10" name="password_conf" type="password" value="" size="25" required />
			</div>

			<center>
				<div class="form_group form_group-horizontal">
				<input type="submit" name="valider" value="Valider">
				<input class="button" type="reset" value="Effacer">
				<a class="button" href="connexion">Connexion</a>
				</div>
		</center>

  </form>
</div>


</body>
</html>
<?php
}
}
/* {/block 'body'} */
}
