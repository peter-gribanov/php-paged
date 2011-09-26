<?php
namespace Paged;

/**
 * Вид показывает первую и последнюю страницу
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
class ViewFerstLast extends PluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
	 */
	public function getList(){
		$menu = $this->export();
		$list = parent::getList();

		$tpl = $menu['ferst']!=$menu['active'] ? 'ferst.php' : 'ferst_active.php';
		array_unshift($list, Template::getTemplate($tpl, array(
			$menu['ferst'],
			(isset($menu['first_link']) ? $menu['first_link'] : ''),
			Language::getMessage('page_ferst'),
			Language::getMessage('page_ferst_name')
		)));

		$tpl = $menu['last']!=$menu['active'] ? 'last.php' : 'last_active.php';
		array_push($list, Template::getTemplate($tpl, array(
			$menu['last'],
			(isset($menu['paged_link']) ? $menu['paged_link'] : '?'.$menu['variable'].'=').$menu['last'],
			Language::getMessage('page_last'),
			Language::getMessage('page_last_name')
		)));

		return $list;
	}

}