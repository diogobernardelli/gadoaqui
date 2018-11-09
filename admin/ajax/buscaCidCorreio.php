<?php
header("Content-Type: text/html; charset=UTF-8");
chdir('../../');
require_once 'pacotes/controller/AjaxController.php';
$ajaxcontrol = new AjaxController();
echo $ajaxcontrol->getCidadesCorreios($_GET['uf'],$_GET['cid']);
unset($ajaxcontrol,$_GET);
?>