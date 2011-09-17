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
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
	 */
	public function getList(){
		$menu = $this->menu->export();
		$link = '?'.$menu['variable'].'=';

		$list = array();
		foreach ($menu['list'] as $item)
			$list[] = Template::getTemplate('primary.php', array($item, $link));

		return $list;
	}

	/**
	 * Выводит меню в виде списка
	 * 
	 * @return	array
	 */
	public function showList(){
		$menu = $this->menu->export();
		$link = '?'.$menu['variable'].'=';

		foreach ($menu['list'] as $item)
			Template::showTemplate('primary.php', array($item, $link));
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return string
	 */
	public function getPack(){
	return implode('', $this->getList());
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return string
	 */
	public function showPack(){
		$this->showList();
	}

}