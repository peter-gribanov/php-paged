<?php
namespace Paged;

/**
 * Клас для включения языковых сообщений
 * Выполняет функцию многоязычности
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
 */
class Language {

	/**
	 * Список языковых сообщений
	 * 
	 * @var	array
	 */
	private static $messages;

	/**
	 * Идентификатор языка
	 * 
	 * @var	string
	 */
	private static $lang_id = self::DEFAUL_LANG;


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
	 * Устанавливает идентификатор языка
	 * 
	 * @param	string	$id
	 * @throws	\InvalidArgumentException
	 * @return	boolean
	 */
	public static function setLangID($id){
		if (!is_string($id) || !trim($id) || strlen($id)!=2){
			throw new \InvalidArgumentException(Language::getMessage('error_lang_id'));
			return false;
		}

		$path = str_replace('\\', '/', dirname(__DIR__).'/lang/'.$id.'/');
		if (!is_dir($path)){
			throw new \InvalidArgumentException(Language::getMessage('error_lang_id_path', $id));
			return false;
		}

		self::$lang_id = $id;
		self::$messages = null;
		return true;
	}

	/**
	 * Загружает список языковых сообщений
	 * 
	 * @throws	\Exception
	 * @return	void
	 */
	private static function loadMessages(){
		if (!is_array(self::$messages)){
			$file = str_replace('\\', '/', dirname(__DIR__).'/lang/'.self::$lang_id.'/.parameters.php');
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