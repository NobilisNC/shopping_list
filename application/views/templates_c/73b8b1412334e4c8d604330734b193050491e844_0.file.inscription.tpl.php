<?php
/* Smarty version 3.1.30, created on 2016-12-14 16:07:27
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/Accueil/inscription.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5851602fa9db61_66782408',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73b8b1412334e4c8d604330734b193050491e844' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/Accueil/inscription.tpl',
      1 => 1481728046,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_5851602fa9db61_66782408 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19405979765851602fa9c8a3_61536451', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_19405979765851602fa9c8a3_61536451 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<body>
	<?php echo validation_errors();?>


    <form name="inscription" method="post" action="<?php echo base_url();?>
index.php/Accueil/inscription">
        <fieldset>
			<legend>Inscription</legend>
			* Login :  <input name="login" type="text" value="" size="25" required /><br />
			* Nom  : <input name="nom" type="text" value="" size="25" required /><br />
			* Prenom :  <input name="prenom" type="text" value="" size="25" required /><br />
			* Mail : <input name="mail" type="email" value="" size="25" required /><br />
			* Mot De Passe :	<input name="password" type="password" value="" size="25" required /><br />
			* Confirmation : <input name="password_conf" type="password" value="" size="25" required /><br />
			<input type="submit" name="valider" value="Valider">
			<input type="reset" value="Effacer">

			<a href="index.php/Accueil/inscription"><input type="button" value="J'ai déja un compte" /></a> <br />

			* = Champs obligatoires
        </form>
    </fieldset>
</body>
</html>
<?php
}
}
/* {/block 'body'} */
}
