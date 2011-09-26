<?php
namespace Paged;

/**
 * Вид показывает предыдущую и следующую страницу
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
class ViewPreviousNext extends PluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
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
		array_unshift($list, Template::getTemplate($tpl, array(
			$menu['previous'],
			$link,
			Language::getMessage('page_previous'),
			Language::getMessage('page_previous_name')
		)));

		$tpl = $menu['next']!=$menu['active'] ? 'next.php' : 'next_active.php';
		array_push($list, Template::getTemplate($tpl, array(
			$menu['next'],
			(isset($menu['paged_link']) ? $menu['paged_link'] : '?'.$menu['variable'].'=').$menu['next'],
			Language::getMessage('page_next'),
			Language::getMessage('page_next_name')
		)));

		return $list;
	}

}