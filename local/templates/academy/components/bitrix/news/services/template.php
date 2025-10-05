<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

switch ($componentPage) {
    case 'detail':
        include __DIR__ . '/detail.php';
        break;
    case 'section':
       
    case 'news':
    default:
        include __DIR__ . '/news.php';
        break;
}
