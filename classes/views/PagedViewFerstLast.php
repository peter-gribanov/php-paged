<?php

/**
 * Вид показывает первую и последнюю страницу
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
class PagedViewFerstLast extends PagedPluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList(){
		$menu = $this->export();
		$list = parent::getList();

		$tpl = $menu['ferst']!=$menu['active'] ? 'ferst.php' : 'ferst_active.php';
		array_unshift($list, PagedTemplate::getTemplate($tpl, array(
			$menu['ferst'],
			(isset($menu['first_link']) ? $menu['first_link'] : ''),
			PagedLanguage::getMessage('page_ferst'),
			PagedLanguage::getMessage('page_ferst_name')
		)));

		$tpl = $menu['last']!=$menu['active'] ? 'last.php' : 'last_active.php';
		array_push($list, PagedTemplate::getTemplate($tpl, array(
			$menu['last'],
			(isset($menu['paged_link']) ? $menu['paged_link'] : '?'.$menu['variable'].'=').$menu['last'],
			PagedLanguage::getMessage('page_last'),
			PagedLanguage::getMessage('page_last_name')
		)));

		return $list;
	}

}