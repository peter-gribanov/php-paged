<?php

/**
 * Кэширует вывод
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0.1 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @link		http://peter-gribanov.ru/open-source/paged_4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class PagedViewCache extends PagedPluginView {

	/**
	 * Кэш списка
	 * 
	 * @var	array
	 */
	private $list_cashe = array();

	/**
	 * Кэш упакованного списка
	 * 
	 * @var	string
	 */
	private $pack_cashe = '';


	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList(){
		if (!$this->list_cashe)
			$this->list_cashe = parent::getList();

		return $this->list_cashe;
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return	string	Меню упакованное в строку
	 */
	public function getPack(){
		if (!$this->pack_cashe)
			$this->pack_cashe = parent::getPack();

		return $this->pack_cashe;
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return	void
	 */
	public function showPack(){
		echo $this->getPack();
	}

}