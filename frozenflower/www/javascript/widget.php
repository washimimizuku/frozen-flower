<?php

require_once('Smarty.class.php');
require_once('../../lib/Planet.php');

$smarty = new Smarty;

$smarty->template_dir = '../../templates/';
$smarty->compile_dir  = '../../templates_c/';
$smarty->config_dir   = '../../configs/';
$smarty->cache_dir    = '../../cache/';

$planet = new Planet;

$smarty->assign('posts', $planet->getPosts(10));

$smarty->display('javascript/widget.tpl');

?>
