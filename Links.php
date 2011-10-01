<?php

require_once 'PagedNumbers.php';

/**
 * Класс для составления списка ссылок номеров страниц
 * 
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.4 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/paged/3.4/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class PagedLinks extends PagedNumbers {

	/**
	 * URL адрес первой страници
	 * 
	 * @var	string
	 */
	private $first_link = '';

	/**
	 * URL адрес страници с префиксом
	 * 
	 * @var	string
	 */
	private $paged_link = '';


	/**
	 * Создает экземпляр класса
	 * 
	 * @param	string	$last		Номер последней страницы
	 * @param	integer	$variable	Имя переменной GET
	 * @return	PagedLinks			Объект списка
	 */
	public static function create($last, $variable='page'){
		return parent::create($last)
			->setVariable($variable);
	}

	/**
	 * Устанавливает название переменной
	 * 
	 * Устанавливает название переменной в которой будут передаваться номера страницы
	 * Устанавливает базовые URl адреса для последующего составления ссылок
	 * 
	 * @param	string	$variable	Имя переменной GET
	 * @return	PagedLinks			Объект списка
	 */
	public function setVariable($variable='page'){
		$this->first_link = ($_SERVER['SERVER_PROTOCOL'][4]=='S' ? 'https' : 'http')
			.'://'.$_SERVER['HTTP_HOST']
			.preg_replace('/(\?|&amp;)('.$variable.'=\d*)/', '',
				str_replace('&', '&amp;', $_SERVER['REQUEST_URI']));

		$this->paged_link = $this->first_link
			.(strpos($this->first_link, '?')!==false ? '&amp;' : '?').$variable.'=';

		$this->setActive(isset($_GET[$variable]) ? $_GET[$variable] : 1);
		return $this;
	}

	/**
	 * Возвращает URl адрес активной страницы
	 * 
	 * @return	string	Адрес активной страницы
	 */
	public function getActiveLink(){
		return $this->getActive()>1 ? $this->paged_link.$this->getActive() : $this->first_link;
	}

	/**
	 * Возвращает URl адрес первой страницы
	 * 
	 * @return	string	Адрес первой страницы
	 */
	public function getFirstLink(){
		return $this->first_link;
	}

	/**
	 * Возвращает URl адрес последней страницы
	 * 
	 * @return	string	Адрес последней страницы
	 */
	public function getLastLink(){
		return $this->paged_link.$this->getLast();
	}

	/**
	 * Возвращает URl адрес предыдущей страницы
	 * 
	 * @return	string	Адрес предыдущей страницы
	 */
	public function getPreviousLink(){
		if (($previous=$this->getPrevious())===false) return '';
		return $previous>1 ? $this->paged_link.$previous : $this->first_link;
	}

	/**
	 * Возвращает URl адрес следующей страницы
	 * 
	 * @return	string	Адрес следующей страницы
	 */
	public function getNextLink(){
		return $this->getNext() ? $this->paged_link.$this->getNext() : '';
	}

	/**
	 * Возвращает список URl адресов страниц
	 * 
	 * @return	array	Список адресов страниц
	 */
	public function getListLinks(){
		$numList = $this->getList();
		$list = array();
		foreach ($numList as $n){
			$list[$n] = $n>1 ? $this->paged_link.$n : $this->first_link;
		}
		return $list;
	}

}