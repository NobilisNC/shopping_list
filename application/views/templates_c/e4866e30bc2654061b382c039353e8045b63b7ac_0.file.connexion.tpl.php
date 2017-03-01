<?php
/* Smarty version 3.1.30, created on 2017-03-01 09:27:37
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\Accueil\connexion.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b694091aaa07_82913349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4866e30bc2654061b382c039353e8045b63b7ac' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\Accueil\\connexion.tpl',
      1 => 1488314862,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout.tpl' => 1,
  ),
),false)) {
function content_58b694091aaa07_82913349 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3028858b694091a8193_00923900', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_3028858b694091a8193_00923900 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="col-left-1 col-10">

    <?php if (isset($_smarty_tpl->tpl_vars['not_logged']->value)) {?>
      <div class="alert alert-red">
        <p>Vous devez être connecté pour acceder à la page demandée.</p>
      </div>
    <?php }?>


    <?php if ($_smarty_tpl->tpl_vars['inscription_success']->value === TRUE) {?>
    <div class="alert alert-green">
      <p>Votre compte a bien été créé. Vous pouvez désormais vous connecter.</p>
    </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['inscription_success']->value === FALSE) {?>
    <div class="alert alert-red">
      <p>Une erreur est survenue lors de votre inscription.</p>
    </div>
    <?php }?>

<?php $_smarty_tpl->_assignInScope('errors', validation_errors());
?>
    <?php if ($_smarty_tpl->tpl_vars['errors']->value) {?>
    <div class="alert alert-red">
      <?php echo $_smarty_tpl->tpl_vars['errors']->value;?>

    </div>
    <?php }?>

  <center>
  <div class="">
	<form class="form" method="post" action="<?php echo site_url();?>
/Accueil/connexion">

			<legend>Connexion</legend>

        <div class="form_group">
				<label for="login">Pseudo :</label>
        <input name="login" type="text" id="pseudo" />
      </div>
      <div class="form_group">
				<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
			</div>

      <div class="form_group-horizontal form_group">
        <input type="submit" value="Connexion" /></p>
        <a class="button" href="inscription">Pas encore inscrit ?</a>
    </div>


	</form>
</div>
</center>

</div>
<?php
}
}
/* {/block 'body'} */
}
