<?php

/**
 * Вид показывает предыдущую и следующую страницу
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
class PagedViewPreviousNext extends PagedPluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList(){
		$menu = $this->export();
		$list = parent::getList();

		if ($menu['previous']===false){
			$link = isset($menu['first_link']) ? $menu['first_link'] : '';
		} else {
			$link = isset($menu['paged_link']) ? $menu['paged_link'] : '?'.$menu['variable'].'=';
			$link .= $menu['previous'];
		}

		$tpl = $menu['previous']!==false ? 'previous.php' : 'previous_active.php';
		array_unshift($list, PagedTemplate::getTemplate($tpl, array(
			$menu['previous'],
			$link,
			PagedLanguage::getMessage('page_previous'),
			PagedLanguage::getMessage('page_previous_name')
		)));

		$tpl = $menu['next']!==false ? 'next.php' : 'next_active.php';
		array_push($list, PagedTemplate::getTemplate($tpl, array(
			$menu['next'],
			(isset($menu['paged_link']) ? $menu['paged_link'] : '?'.$menu['variable'].'=').$menu['next'],
			PagedLanguage::getMessage('page_next'),
			PagedLanguage::getMessage('page_next_name')
		)));

		return $list;
	}

}