<?php
use Paged\Language;
use Paged\Facade;

header('Content-type: text/html; charset=utf-8');

require 'Facade.php';

try {

Language::setLangID('ru');

$menu = Facade::getMenu()
	->setListLength(5)
	->setActive(2)
	->setVariable('p')
	->setLast(15);

$view = Facade::setView($menu, 'Links');
$view = Facade::setView($view, 'PreviousNext');
$view = Facade::setView($view, 'FerstLast');
$view = Facade::setView($view, 'List');
$view = Facade::setView($view, 'Wrapper');
$view = Facade::setView($view, 'Cache');

$view->showPack();

} catch (Exception $e){
	exit('Error: '.$e->getMessage());
}