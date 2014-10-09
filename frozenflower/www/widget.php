<?php

require_once('../lib/SmartySetup.php');
require_once('../lib/Planet.php');

$smarty = new SmartySetup();
$planet = new Planet;

$smarty->assign('feeds', $planet->getFeeds());

$smarty->display('widget.tpl');

?>
