<?php
/* Smarty version 3.1.30, created on 2016-12-14 14:20:09
  from "/home/nobilis/coding/server/html/projet_tut/application/views/templates/nav/nav.inc.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58514709032ec0_04805491',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5907e6b0be73573635cfb3f9ade78bcd458f8b9' => 
    array (
      0 => '/home/nobilis/coding/server/html/projet_tut/application/views/templates/nav/nav.inc.tpl',
      1 => 1481720978,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58514709032ec0_04805491 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="index">Accueil</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if (!isset($_SESSION['login'])) {?>
				<li><a href="connexion">Se connecter</a></li>
			<?php } else { ?>
				<li><a href="#"><span class="fui-user"></span><?php echo $_SESSION['login'];?>
</a></li>
				<li><a href="#"><span class="fui-lock"></span> Se déconnecter</a></li>
			<?php }?>
		</ul>
	</div>
</nav>
<?php }
}
