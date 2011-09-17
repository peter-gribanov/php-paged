<?php
use Paged\Menu;
use Paged\Template;

define('LANG', 'ru');
header('Content-type: text/html; charset=utf-8');

require 'classes/Language.php';
require 'classes/Menu.php';
require 'classes/Template.php';

try {

$menu = Menu::instance()
	->setListLength(10)
	->setActive(1)
	->setVariable('p');


Template::getTemplate('demo.php', $menu->export());

} catch (Exception $e){
	exit('Error: '.$e->getMessage());
}