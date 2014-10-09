<?php

require_once('../lib/SmartySetup.php');
require_once('../lib/Planet.php');

$smarty = new SmartySetup();
$planet = new Planet;

#$smarty->assign('posts', $planet->getPosts(20));
$smarty->assign('feeds', $planet->getFeeds());

$smarty->display('request.tpl');

?>
