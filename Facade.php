<?php
namespace Paged;

require 'classes/Language.php';
require 'classes/Template.php';
require 'classes/Menu.php';
require 'classes/PrimaryView.php';
require 'classes/PluginView.php';

/**
 * Фасад для библиотеки
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @link		http://peter-gribanov.ru/#open-source/paged/paged_4-x
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 * @example		example1.php Example 1
 * @example		example2.php Example 2
 * @example		example3.php Example 3
 */
class Facade {

	/**
	 * Список загруженных видов
	 * 
	 * @var	array
	 */
	private static $view_load_list = array();

	/**
	 * Список загруженных моделей
	 * 
	 * @var	array
	 */
	private static $model_load_list = array();


	/**
	 * Возвращает объект меню
	 * 
	 * @return	\Paged\Menu
	 */
	public static function getMenu(){
		return new Menu();
	}

	/**
	 * Накладывает на меню вид и возвращает результат
	 * 
	 * @param	object	$menu
	 * @param	string	$view_name
	 * @throws	\Exception
	 * @return	\Paged\PrimaryView
	 */
	public static function setView($menu, $view_name=null){
		if (!is_object($menu))
			throw new InvalidArgumentException(Language::getMessage('error_view_object'));

		// меню еще не упаковано ни в какой вид
		if ($menu instanceof \Paged\Menu)
			$menu = new PrimaryView($menu);

		if ($view_name===null)
			return $menu;

		$class_name = 'View'.$view_name;

		// защита от повторной попытки загруски класса с целью экономии ресупсов
		if (in_array($class_name, self::$view_load_list)){
			return $class_name($menu);
		}

		// загружаем вид
		$path = str_replace('\\', '/', dirname(__FILE__)).'/classes/views/';
		if (!file_exists($path.$class_name.'.php'))
			throw new \Exception(Language::getMessage('error_view_file', $view_name));

		require_once $path.$class_name.'.php';
		$class_name = '\Paged\\'.$class_name;

		if (!class_exists($class_name))
			throw new \Exception(Language::getMessage('error_view_class', $view_name));

		// инициалезируем вид
		$view = new $class_name($menu);
		if (!($view instanceof \Paged\View))
			throw new \Exception(Language::getMessage('error_view_interface', $view_name));

		self::$view_load_list[] = $class_name;

		return $view;
	}

	/**
	 * Устанавливает идентификатор языка
	 * 
	 * @param	string	$id
	 * @throws	\InvalidArgumentException
	 * @return	boolean
	 */
	public static function setLangID($id){
		return Language::setLangID($id);
	}

	/**
	 * Enter description here ...
	 * 
	 * @param	string	$id
	 * @throws	\InvalidArgumentException
	 * @return	boolean
	 */
	public static function setTemplateID($id){
		return Template::setTemplateID($id);
	}

}
