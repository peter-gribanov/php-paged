<?php
namespace Paged;

/**
 * Вид с поддержкой полных ссылок
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @tutorial	http://peter-gribanov.ru/#open-source/paged/paged_4-x
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */

class ViewLinks extends PluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
	 */
	public function getList(){
		$menu = $this->export();

		$list = array();
		if ($menu['list']){
			$first = array_shift($menu['list']);
			$tpl = $first!=$menu['active'] ? 'primary.php' : 'primary_active.php';
			$list[] = Template::getTemplate($tpl, array($first, $menu['first_link'], Language::getMessage('page_number', $first)));
		}
		foreach ($menu['list'] as $item){
			if ($item==$menu['active']){
				$link = $menu['first_link'];
				$tpl = 'primary_active.php';
			} else {
				$link = $menu['paged_link'].$item;
				$tpl = 'primary.php';
			}
			$list[] = Template::getTemplate($tpl, array($item, $link, Language::getMessage('page_number', $item)));
		}

		return $list;
	}

	/**
	 * Экспортирует данные модели
	 * 
	 * @return	array
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