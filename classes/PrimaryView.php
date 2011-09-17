<?php
namespace Paged;

/**
 * Основной вид для меню
 * Он является базовым для других видов
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
class PrimaryView {

	/**
	 * Декорируемый объект модели
	 * 
	 * @var	\Paged\Menu
	 */
	protected $menu;


	/**
	 * Конструктор декарирующий модель
	 * 
	 * @param	\Paged\Menu	$menu
	 * @return	void
	 */
	public function __construct(Menu $menu){
		$this->menu = $menu;
	}

	/**
	 * Возвращает/Выводит меню в виде списка
	 * 
	 * @param	boolen	$return
	 * @return	array
	 */
	public function getList($return=false){
		$menu = $this->menu->export();
		$link = '?'.$menu['variable'].'=';

		if ($return){
			$list = array();
			foreach ($menu['list'] as $item)
				$list[] = Template::getTemplate('primary.php', array($item, $link));

			return $list;

		} else {
			foreach ($menu['list'] as $item)
				Template::showTemplate('primary.php', array($item, $link));
		}
	}

	/**
	 * Возвращает/Выводит меню упакованное в строку
	 * 
	 * @param	boolen	$return
	 * @return string
	 */
	public function getPack($return=false){
		if ($return){
			return implode('', $this->getList(), $return);
		} else {
			$this->getList($return);
		}
	}

}