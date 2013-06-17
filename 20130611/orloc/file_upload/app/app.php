<?php
use Db\DbConnection;
use Distort\Distort;

include_once __DIR__.'/config.php';

$db = DbConnection::getInstance($config);

$flashBag = new Utility\FlashBag();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    unset($_SESSION);

    $im = new Distort($db, $_FILES['file']);
    $flag = $im->upload();
    $im = $im->doDistortion(); 
    
    $_SESSION[$im->getPath()] = $im->getWebPath();

    if ($flag){
        $flashBag->addMessage('success', sprintf("You have successfully uploaded %s!", $im->getName()));
    } else {
        $flashBag->addMessage('error', sprintf("You done messed up, could not upload %s", $im->getName()));
    }
}

include __DIR__.'/../resources/views/form.html.php';

