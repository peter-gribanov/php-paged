<?php
namespace Paged;

/**
 * Модель описывающая список страниц
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
interface MenuInterface {

	/**
	 * Устанавливает номер последней страницы
	 *
	 * @param	integer	$last
	 * @throws	\InvalidArgumentException
	 * @return	\Paged\Menu
	 */
	public function setLast($last);

	/**
	 * Устанавливает длинну списка ссылок
	 * 
	 * @param	integer	$length
	 * @throws	\InvalidArgumentException
	 * @return	\Paged\Menu
	 */
	public function setListLength($length=0);

	/**
	 * Устанавливает номер активной страницы
	 * 
	 * @param	integer	$active
	 * @throws	\InvalidArgumentException
	 * @return	\Paged\Menu
	 */
	public function setActive($active);

	/**
	 * Устанавливает название переменной GET в которой будут передаваться номера страницы
	 * 
	 * @param	string	$variable
	 * @throws	\InvalidArgumentException
	 * @return	\Paged\Menu
	 */
	public function setVariable($variable);

	/**
	 * Экспортирует данные модели
	 * 
	 * @return	array
	 */
	public function export();

}