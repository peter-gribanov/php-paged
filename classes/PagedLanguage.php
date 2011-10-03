<?php

/**
 * Класс для включения языковых сообщений
 * 
 * Класс для получения сообщения языковых тем. Класс выполняет функцию многоязычности.
 * По умолчанию используется Английская языковая тема
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
class PagedLanguage {

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
	 * @param	string	$key	Ключ сообщения
	 * @throws	Exception
	 * @return	mixid			Сообщение
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
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param	string	$id					Идентификатор языка
	 * @throws	InvalidArgumentException	Недопустимый идентификатор
	 * @throws	Exception					Не найдена языковая тема
	 * @return	boolean						Результат установки
	 */
	public static function setLangID($id){
		if (!is_string($id) || !trim($id) || strlen($id)!=2){
			throw new InvalidArgumentException(self::getMessage('error_lang_id'));
			return false;
		}

		$path = str_replace('\\', '/', dirname(dirname(__FILE__)).'/lang/'.$id.'/');
		if (!is_dir($path)){
			throw new Exception(self::getMessage('error_lang_id_path', $id));
			return false;
		}

		self::$lang_id = $id;
		self::$messages = null;
		return true;
	}

	/**
	 * Загружает список сообщений языковой темы
	 * 
	 * @throws	Exception	Языковая тема не обнаружена
	 * @return	void
	 */
	private static function loadMessages(){
		if (!is_array(self::$messages)){
			$file = str_replace('\\', '/', dirname(dirname(__FILE__)).'/lang/'.self::$lang_id.'/.parameters.php');
			if (!file_exists($file)){
				throw new Exception('File with language messages is not set.');
				return false;
			}

			include $file;
			self::$messages = isset($mess) && is_array($mess) ? $mess : array();
		}
		return true;
	}

}