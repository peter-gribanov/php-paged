<?php
require 'classes/PagedLanguage.php';
require 'classes/PagedTemplate.php';
require 'classes/PagedMenu.php';
require 'classes/PagedPrimaryView.php';
require 'classes/PagedPluginView.php';

/**
 * Фасад для библиотеки
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0.1 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/paged/4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class Paged {

	/**
	 * Список загруженных моделей
	 * 
	 * @var	array
	 */
	private static $model_load_list = array();


	/**
	 * Возвращает объект меню
	 * 
	 * @return	PagedMenu	Объект меню
	 */
	public static function getMenu(){
		return new PagedMenu();
	}

	/**
	 * Накладывает на меню вид и возвращает результат
	 * 
	 * Принимает объект меню или объект меню, обернутый в вид,
	 * и накладывает на него новый вид.
	 * Если передан объект меню, то сначала накладывает основной вид.
	 * Если указано название накладываемого вида, то загружает
	 * и накладывает его на объект меню, упакованный в первичный
	 * или любой другой вид отвечающий интерфейсу PagedView
	 * 
	 * @param	object	$menu				Объект меню или вида
	 * @param	string	$view_name			Имя накладываемого вида
	 * @throws	InvalidArgumentException	Не указан объект меню
	 * @throws	Exception					Не найден файл вида
	 * @throws	Exception					Не найден класс вида
	 * @throws	Exception					Вид не соответствует интерфейсу PagedView
	 * @return	PagedPrimaryView			Объект вида
	 */
	public static function setView($menu, $view_name=null){
		if (!is_object($menu))
			throw new InvalidArgumentException(PagedLanguage::getMessage('error_view_object'));

		// меню еще не упаковано ни в какой вид
		if ($menu instanceof PagedMenu)
			$menu = new PagedPrimaryView($menu);

		if ($view_name===null)
			return $menu;

		$class_name = 'PagedView'.$view_name;

		// если вид не загружен загружаем его
		if (!class_exists($class_name)){
			$path = str_replace('\\', '/', dirname(__FILE__)).'/classes/views/';
			if (!file_exists($path.$class_name.'.php'))
				throw new Exception(PagedLanguage::getMessage('error_view_file', $view_name));

			require $path.$class_name.'.php';

			if (!class_exists($class_name))
				throw new Exception(PagedLanguage::getMessage('error_view_class', $view_name));

		}

		// инициалезируем вид
		$view = new $class_name($menu);
		if (!($view instanceof PagedView))
			throw new Exception(PagedLanguage::getMessage('error_view_interface', $view_name));

		return $view;
	}

	/**
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param	string	$id					Идентификатор языка
	 * @throws	InvalidArgumentException	Недопустимый идентификатор
	 * @throws	Exception					Не найдена языковая тема
	 * @return	boolean						Результат установки
	 */
	public static function setLangID($id){
		return PagedLanguage::setLangID($id);
	}

	/**
	 * Устанавливает идентификатор шаблона
	 * 
	 * @param	string	$id					Идентификатор шаблона
	 * @throws	InvalidArgumentException	Недопустимый идентификатор
	 * @throws	Exception					Не найден шаблон
	 * @return	boolean						Результат установки
	 */
	public static function setTemplateID($id){
		return PagedTemplate::setTemplateID($id);
	}

}