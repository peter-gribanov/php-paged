<?php

/**
 * Простейшая обертка элиментов
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
class PagedViewWrapper extends PagedPluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList(){
		$list = parent::getList();
		$list_new = array(); 
		foreach ($list as $item)
			$list_new[] = PagedTemplate::getTemplate('wrapper.php', array($item));

		return $list_new;
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return	string	Меню упакованное в строку
	 */
	public function getPack(){
		return PagedTemplate::getTemplate('wrapper_pack.php', array(parent::getPack()));
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return	void
	 */
	public function showPack(){
		PagedTemplate::showTemplate('wrapper_pack.php', array(parent::getPack()));
	}

}