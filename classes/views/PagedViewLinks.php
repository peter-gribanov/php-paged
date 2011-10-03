<?php

/**
 * Вид с поддержкой полных ссылок
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
class PagedViewLinks extends PagedPluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList(){
		$menu = $this->export();

		$list = array();
		if ($menu['list']){
			$first = array_shift($menu['list']);
			$tpl = $first!=$menu['active'] ? 'primary.php' : 'primary_active.php';
			$list[] = PagedTemplate::getTemplate($tpl, array(
				$first,
				$menu['first_link'],
				PagedLanguage::getMessage('page_number', $first)
			));
		}
		foreach ($menu['list'] as $item){
			if ($item==$menu['active']){
				$link = $menu['first_link'];
				$tpl = 'primary_active.php';
			} else {
				$link = $menu['paged_link'].$item;
				$tpl = 'primary.php';
			}
			$list[] = PagedTemplate::getTemplate($tpl, array(
				$item,
				$link,
				PagedLanguage::getMessage('page_number', $item)
			));
		}

		return $list;
	}

	/**
	 * Экспортирует данные модели
	 * 
	 * @see		PagedMenu::export()
	 * @return	array	Данные модели
	 */
	public function export(){
		$menu = parent::export();

		// первая страница
		$menu['first_link'] = ($_SERVER['SERVER_PROTOCOL'][4]=='S' ? 'https' : 'http')
			.'://'.$_SERVER['HTTP_HOST']
			.preg_replace('/(\?|&amp;)('.preg_quote($menu['variable'], '/').'=\d*)/', '',
				str_replace('&', '&amp;', $_SERVER['REQUEST_URI']));

		// страница с префиксом
		$menu['paged_link'] = $menu['first_link']
			.(strpos($menu['first_link'], '?')!==false ? '&amp;' : '?').$menu['variable'].'=';

		return $menu;
	}

}