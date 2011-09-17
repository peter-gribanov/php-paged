<?php
namespace Paged;

/**
 * Клас для включения языковых сообщений
 * Выполняет функцию многоязычности
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
class Language {

	/**
	 * Список языковых сообщений
	 * 
	 * @var	array
	 */
	private static $messages;


	/**
	 * Язык по умолчанию
	 * 
	 * @var	string
	 */
	const DEFAUL_LANG = 'en';


	/**
	 * Возвращает сообщение для указанного ключа
	 * 
	 * @param	string	$key
	 * @throws	\Exception
	 * @return	mixid
	 */
	public static function getMessage($key){
		self::loadMessages();

		if (func_num_args()==1){
			return isset(self::$messages[$key]) ? self::$messages[$key] : false; 

		} elseif (func_num_args()>1){
			if (!isset(self::$messages[$key])) return false;
			$params = func_get_args();
			$params[0] =  self::$messages[$key];
			return call_user_func_array('sprintf', $params);
		}
	}

	/**
	 * Загружает список языковых сообщений
	 * 
	 * @throws	\Exception
	 * @return	void
	 */
	private static function loadMessages(){
		if (!is_array(self::$messages)){
			$id = defined('LANG') ? LANG : self::DEFAUL_LANG;
			$file = str_replace('\\', '/', dirname(dirname(__FILE__)).'/lang/'.$id.'/.parameters.php');
			if (!file_exists($file)){
				throw new \Exception('File with language messages is not set.');
				return false;
			}

			include $file;
			self::$messages = isset($mess) && is_array($mess) ? $mess : array();
		}
		return true;
	}

}