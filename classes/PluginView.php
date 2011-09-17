<?php
namespace Paged;

require_once 'View.php';

/**
 * Базовый декоратор для вида
 * Виды могут декорировать только другие виды
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
abstract class PluginView implements View {

	/**
	 * Декорируемый объект модели
	 * 
	 * @var	\Paged\View
	 */
	private $view;


	/**
	 * Конструктор декарирующий вида
	 * 
	 * @param	\Paged\View	$view
	 * @return	void
	 */
	public function __construct(View $view){
		$this->view = $view;
	}

	/**
	 * Возвращает меню в виде списка
	 * 
	 * @return	array
	 */
	public function getList(){
		return $this->view->getList();
	}

	/**
	 * Возвращает меню упакованное в строку
	 * 
	 * @return string
	 */
	public function getPack(){
		return $this->view->getPack();
	}

	/**
	 * Выводит меню упакованное в строку
	 * 
	 * @return void
	 */
	public function showPack(){
		$this->view->showPack();
	}

	/**
	 * Экспортирует данные модели
	 * 
	 * @return	array
	 */
	public function export(){
		return $this->view->export();
	}

}