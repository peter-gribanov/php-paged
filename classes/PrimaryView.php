<?php
namespace Paged;

require_once 'View.php';

/**
 * Основной вид для меню
 * Он является базовым для других видов
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
class PrimaryView implements View {

	/**
	 * Декорируемый объект модели
	 * 
	 * @var	\Paged\Menu
	 */
	private $menu;


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
		$menu = $this->export();
		$link = '?'.$menu['variable'].'=';

		$list = array();
		if ($menu['list']){
			$first = array_shift($menu['list']);
			$tpl = $first!=$menu['active'] ? 'primary.php' : 'primary_active.php';
			$list[] = Template::getTemplate($tpl, array($first, '', Language::getMessage('page_number', $first)));
		}
		foreach ($menu['list'] as $item){
			$tpl = $item!=$menu['active'] ? 'primary.php' : 'primary_active.php';
			$list[] = Template::getTemplate($tpl, array($item, $link.$item, Language::getMessage('page_number', $item)));
		}

		return $list;
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return string
	 */
	public function getPack(){
		return Template::getTemplate('primary_pack.php', $this->getList());
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return void
	 */
	public function showPack(){
		Template::showTemplate('primary_pack.php', $this->getList());
	}

	/**
	 * Экспортирует данные модели
	 * 
	 * @return	array
	 */
	public function export(){
		return $this->menu->export();
	}

}