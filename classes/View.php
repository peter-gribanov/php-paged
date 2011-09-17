<?php
namespace Paged;

/**
 * Интерфейс вида
 * 
 * @category	Basic library
 * @package		Paged
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		SVN: $Revision$
 * @link		$HeadURL$
 * @tutorial	http://peter-gribanov.ru/#open-source/paged
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 * @since		File available since Release 3.4
 */
interface View {

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
	 */
	public function getList();

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return string
	 */
	public function getPack();

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return void
	 */
	public function showPack();

	/**
	 * Экспортирует данные модели
	 * 
	 * @return	array
	 */
	public function export();

}