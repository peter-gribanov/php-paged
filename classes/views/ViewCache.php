<?php
namespace Paged;

/**
 * Кэширует вывод
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
class ViewCache extends PluginView {

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
	 * @return	array
	 */
	public function getList(){
		if (!$this->list_cashe)
			$this->list_cashe = parent::getList();

		return $this->list_cashe;
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return string
	 */
	public function getPack(){
		if (!$this->pack_cashe)
			$this->pack_cashe = parent::getPack();

		return $this->pack_cashe;
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return void
	 */
	public function showPack(){
		echo $this->getPack();
	}

}