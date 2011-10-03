<?php
require_once 'PagedView.php';

/**
 * Основной вид для меню
 * 
 * Основной вид для меню являющийся базовым для других видов
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0.1 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/paged/4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class PagedPrimaryView implements PagedView {

	/**
	 * Декорируемый объект модели
	 * 
	 * @var	PagedMenu
	 */
	private $menu;


	/**
	 * Конструктор декарирующий модель
	 * 
	 * @param	PagedMenu	$menu	Объект меню
	 * @return	void
	 */
	public function __construct(PagedMenu $menu){
		$this->menu = $menu;
	}

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList(){
		$menu = $this->export();
		$link = '?'.$menu['variable'].'=';

		$list = array();
		if ($menu['list']){
			$first = array_shift($menu['list']);
			$tpl = $first!=$menu['active'] ? 'primary.php' : 'primary_active.php';
			$list[] = PagedTemplate::getTemplate($tpl, array($first, '', PagedLanguage::getMessage('page_number', $first)));
		}
		foreach ($menu['list'] as $item){
			$tpl = $item!=$menu['active'] ? 'primary.php' : 'primary_active.php';
			$list[] = PagedTemplate::getTemplate($tpl, array($item, $link.$item, PagedLanguage::getMessage('page_number', $item)));
		}

		return $list;
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return	string	Меню упакованное в строку
	 */
	public function getPack(){
		return PagedTemplate::getTemplate('primary_pack.php', $this->getList());
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return	void
	 */
	public function showPack(){
		PagedTemplate::showTemplate('primary_pack.php', $this->getList());
	}

	/**
	 * Экспортирует данные модели
	 * 
	 * @see		PagedMenu::export()
	 * @return	array	Данные модели
	 */
	public function export(){
		return $this->menu->export();
	}

}