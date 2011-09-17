<?php
namespace Paged;

/**
 * Клас для включения шаблонов
 * Выполняет функцию шаблонизайии
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @tutorial	http://peter-gribanov.ru/#open-source/paged
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class Template {

	/**
	 * Путь к шаблону
	 * 
	 * @var	string
	 */
	private static $template_path;

	/**
	 * Идентификатор шаблону
	 * 
	 * @var	string
	 */
	private static $template_id = self::DEFAULT_TEMPLATE;


	/**
	 * Шаблон по умолчанию
	 * 
	 * @var	string
	 */
	const DEFAULT_TEMPLATE = '.default';


	/**
	 * Возвращает результат применения шаблона
	 * 
	 * @param	string	$path
	 * @param	array	$result
	 * @throws	\Exception
	 * @return	string
	 */
	public static function getTemplate($path, $result=null){
		$tpl = false;
		$buffer = ob_get_contents();
		ob_clean();
		if (self::showTemplate($path, $result)){
			$tpl = ob_get_contents();
			ob_clean();
		}
		echo $buffer;
		return $tpl;
	}

	/**
	 * Подключает шаблон
	 * 
	 * @param	string	$path
	 * @param	array	$result
	 * @throws	\Exception
	 * @return	boolen
	 */
	public static function showTemplate($path, $result=null){
		if (!file_exists(self::getTemplatePath().$path)){
			throw new \Exception(Language::getMessage('error_template_load', $path));
			return false;
		}

		$result = $result && is_array($result) ? $result : array();
		require self::getTemplatePath().$path;
		return true;
	}

	/**
	 * Возвращает путь к дирректории с шаблоном
	 * 
	 * @return	string
	 */
	public static function getTemplatePath(){
		if (!self::$template_path)
			self::$template_path = str_replace('\\', '/', dirname(dirname(__FILE__)).'/templates/'.self::$template_id.'/');

		return self::$template_path;
	}

	/**
	 * Enter description here ...
	 * 
	 * @param	string	$id
	 * @throws	\InvalidArgumentException
	 * @return	boolean
	 */
	public static function setTemplateID($id){
		if (!is_string($id) || !trim($id)){
			throw new \InvalidArgumentException(Language::getMessage('error_template_id'));
			return false;
		}

		$path = str_replace('\\', '/', dirname(dirname(__FILE__)).'/templates/'.$id.'/');
		if (!is_dir($path)){
			throw new \InvalidArgumentException(Language::getMessage('error_template_id_path', $id));
			return false;
		}

		self::$template_id = $id;
		self::$template_path = $path;
		return true;
	}

}