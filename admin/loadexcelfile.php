<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

//DIRECTORY_SEPARATOR = "\\";

$doc = & JFactory::getDocument();
$doc->addStyleSheet(DIRECTORY_SEPARATOR."administrator".DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR."com_loadexcelfile".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."default.css");
$doc->addStyleSheet(DIRECTORY_SEPARATOR."administrator".DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR."com_loadexcelfile".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."tabs.css");
$doc->addScript(DIRECTORY_SEPARATOR."administrator".DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR."com_loadexcelfile".DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR."custom.js");
require_once( JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controller.php' );

if ($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

$classname	= 'LoadExcelFileController'.$controller;
$controller	= new $classname();

$controller->execute(JRequest::getVar( 'task' ) );
$controller->redirect();

?>