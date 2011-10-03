<?php
require_once 'PagedView.php';

/**
 * Базовый декоратор для вида
 * 
 * Базовый декоратор для вида. Виды могут декорировать только другие виды.
 * Для декарации мадели используется базовый декаратор PagedPrimaryView
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
abstract class PagedPluginView implements PagedView {

	/**
	 * Декорируемый объект модели
	 * 
	 * @var	PagedView
	 */
	private $view;


	/**
	 * Конструктор декарирующий вида
	 * 
	 * @param	PagedView	$view	Объект вида
	 * @return	void
	 */
	public function __construct(PagedView $view){
		$this->view = $view;
	}

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList(){
		return $this->view->getList();
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return	string	Меню упакованное в строку
	 */
	public function getPack(){
		return $this->view->getPack();
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return	void
	 */
	public function showPack(){
		$this->view->showPack();
	}

	/**
	 * Экспортирует данные модели
	 * 
	 * @see		PagedMenu::export()
	 * @return	array	Данные модели
	 */
	public function export(){
		return $this->view->export();
	}

}