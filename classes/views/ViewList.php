<?php
namespace Paged;

/**
 * Выводит список как маркерованный
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
class ViewList extends PluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
	 */
	public function getList(){
		$list = parent::getList();
		$list_new = array(); 
		foreach ($list as $item)
			$list_new[] = Template::getTemplate('list.php', array($item));

		return $list_new;
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return string
	 */
	public function getPack(){
		return Template::getTemplate('list_pack.php', $this->getList());
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return void
	 */
	public function showPack(){
		Template::showTemplate('list_pack.php', $this->getList());
	}

}