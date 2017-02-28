<?php
/* Smarty version 3.1.30, created on 2017-02-28 15:13:13
  from "C:\UwAmp\www\PTUT\shopping_list\application\views\templates\nav\nav.inc.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b59389ba65e7_04694504',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '720686fd93247f6e457dca139e5c415173b93a03' => 
    array (
      0 => 'C:\\UwAmp\\www\\PTUT\\shopping_list\\application\\views\\templates\\nav\\nav.inc.tpl',
      1 => 1488206053,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58b59389ba65e7_04694504 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav>
<ul class="">
	<li><a href="<?php echo site_url();?>
/index">Accueil</a></li>
</ul>
<ul>
	<?php if ($_SESSION['logged_in'] === TRUE) {?>

				<li><a href="<?php echo site_url();?>
/home/list">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							Mes listes
						</a>
				</li>
        <li><a href="<?php echo site_url();?>
/home/amis">
					<i class="fa fa-user-plus" aria-hidden="true"></i>
					Amis</a>
				</li>
				<li><a href="<?php echo site_url();?>
/home/profil"><?php echo $_SESSION['login'];?>
</a></li>
        <li><a href="<?php echo site_url();?>
/home/logout">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					Se déconnecter</a>
				</li>
	<?php } else { ?>
        <li><a href="<?php echo site_url();?>
/accueil/connexion">Se connecter</a></li>
	<?php }?>
</ul>
</nav>
<?php }
}
