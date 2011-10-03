<?php

/**
 * Интерфейс вида меню
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
interface PagedView {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array	Меню в виде списка
	 */
	public function getList();

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return	string	Меню упакованное в строку
	 */
	public function getPack();

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return	void
	 */
	public function showPack();

	/**
	 * Экспортирует данные модели
	 * 
	 * @see		PagedMenu::export()
	 * @return	array	Данные модели
	 */
	public function export();

}