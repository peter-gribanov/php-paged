<?php

require_once 'PagedNumbers.php';

/**
 * Класс для составления списка ссылок номеров страниц
 * 
 * @license GNU GPL Version 3
 * @copyright 2008, Peter Gribanov
 * @link http://peter-gribanov.ru/license
 * @tutorial http://peter-gribanov.ru/#open-source/paged/links
 * @package Paged
 * @author Peter Gribanov
 * @since 18.11.2010
 * @version 3.4
 */
class PagedLinks extends PagedNumbers {

	/**
	 * URL адрес первой страници
	 * 
	 * @var string
	 */
	private $first_link = '';

	/**
	 * URL адрес страници с префиксом
	 * 
	 * @var string
	 */
	private $paged_link = '';


	/**
	 * Создает экземпляр класса
	 * 
	 * @param string $last Имя переменной GET
	 * @param integer $variable
	 * @return PagedLinks
	 */
	public static function create($last, $variable='page'){
		return parent::create($last)->setVariable($variable);
	}

	/**
	 * Устанавливает название переменной в которой будут передаваться номера страницы
	 * Устанавливает базовые URl адреса для последующего составления ссылок
	 * 
	 * @param string $variable Имя переменной GET
	 * @return PagedLinks
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
	 * @return string
	 */
	public function getActiveLink(){
		return $this->getActive()>1 ? $this->paged_link.$this->getActive() : $this->first_link;
	}

	/**
	 * Возвращает URl адрес первой страницы
	 * 
	 * @return string
	 */
	public function getFirstLink(){
		return $this->first_link;
	}

	/**
	 * Возвращает URl адрес последней страницы
	 * 
	 * @return string
	 */
	public function getLastLink(){
		return $this->paged_link.$this->getLast();
	}

	/**
	 * Возвращает URl адрес предыдущей страницы
	 * 
	 * @return string
	 */
	public function getPreviousLink(){
		if (($previous=$this->getPrevious())===false) return '';
		return $previous>1 ? $this->paged_link.$previous : $this->first_link;
	}

	/**
	 * Возвращает URl адрес следующей страницы
	 * 
	 * @return string
	 */
	public function getNextLink(){
		return $this->getNext() ? $this->paged_link.$this->getNext() : '';
	}

	/**
	 * Возвращает список URl адресов страниц
	 * 
	 * @return array
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
?>