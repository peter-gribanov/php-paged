<?php
namespace Paged;

/**
 * Простейшая обертка элиментов
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @tutorial	http://peter-gribanov.ru/#open-source/paged
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class ViewWrapper extends PluginView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
	 */
	public function getList(){
		$list = parent::getList();
		$list_new = array(); 
		foreach ($list as $item)
			$list_new[] = Template::getTemplate('wrapper.php', array($item));

		return $list_new;
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return string
	 */
	public function getPack(){
		return Template::getTemplate('wrapper_pack.php', array(parent::getPack()));
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return void
	 */
	public function showPack(){
		Template::showTemplate('wrapper_pack.php', array(parent::getPack()));
	}

}