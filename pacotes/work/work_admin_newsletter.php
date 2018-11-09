<?php
require_once 'pacotes/controller/NewsletterController.php';
$newslettercontrol = new NewsletterController();

$newsletters = $newslettercontrol->listNewsletters();

unset($newslettercontrol);
?>