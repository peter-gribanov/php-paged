<?php
namespace Paged;

/**
 * Модель описывающая список страниц
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
class Menu {

	/**
	 * Номер активной страницы
	 * 
	 * @var	integer
	 */
	private $active = 1;

	/**
	 * Номер последней страници
	 * 
	 * @var	integer
	 */
	private $last = 1;

	/**
	 * Начало списка номеров
	 * 
	 * @var	integer
	 */
	private $start = 1;

	/**
	 * Конец списка номеров
	 * 
	 * @var	integer
	 */
	private $end = 1;

	/**
	 * Длинна списка номеров страниц
	 * При значении 0 выводит весь список
	 * 
	 * @var	integer
	 */
	private $list_length = self::DEFAUL_LIST_LENGTH;

	/**
	 * Название переменной GET в которой будут передаваться номера страницы
	 * 
	 * @var	string
	 */
	private $variable = self::DEFAUL_VARIABLE;


	/**
	 * Название переменной GET по умолчанию, в которой будут передаваться номера страницы
	 * 
	 * @var	string
	 */
	const DEFAUL_VARIABLE = 'page';


	/**
	 * Длинна списка номеров страниц по умолчанию
	 * При значении 0 выводит весь список
	 * 
	 * @var	integer
	 */
	const DEFAUL_LIST_LENGTH = 10;


	/**
	 * Устанавливает номер последней страницы
	 *
	 * @param	integer	$last
	 * @throws	\InvalidArgumentException
	 * @return	\Paged\Menu
	 */
	public function setLast($last){
		if (!is_int($last) || $last < 1)
			throw new \InvalidArgumentException(Language::getMessage('error_last'));

		$this->last = intval($last);
		$this->end = $this->last;
		return $this;
	}

	/**
	 * Устанавливает длинну списка ссылок
	 * 
	 * @param	integer	$length
	 * @throws	\InvalidArgumentException
	 * @return	\Paged\Menu
	 */
	public function setListLength($length=0){
		if (!is_int($length) || $length < 0)
			throw new \InvalidArgumentException(Language::getMessage('error_list_length'));

		$this->list_length = intval($length);
		return $this;
	}

	/**
	 * Устанавливает номер активной страницы
	 * 
	 * @param	integer	$active
	 * @throws	\InvalidArgumentException
	 * @return	void
	 */
	private function setActive($active){
		if (!is_numeric($active) || intval($active)!=$active || $active < 1)
			throw new \InvalidArgumentException(Language::getMessage('error_active'));

		$this->active = intval($active);
	}

	/**
	 * Устанавливает название переменной GET в которой будут передаваться номера страницы
	 * 
	 * @param	string	$variable
	 * @throws	\InvalidArgumentException
	 * @return	\Paged\Menu
	 */
	public function setVariable($variable){
		if (!is_string($variable) || !trim($variable))
			throw new \InvalidArgumentException(Language::getMessage('error_variable'));

		$this->variable = trim($variable);

		if (isset($_GET[$variable]))
			$this->setActive($_GET[$variable]);

		return $this;
	}

	/**
	 * Возвращает список номеров страниц
	 * 
	 * @return 	array
	 */
	private function calculateList(){
		// список кнопок пуст или длинна не ограничена
		if ($this->last==1 || $this->list_length == 0
			|| $this->list_length > $this->last) return array();

		// предварительное объявление номера первой и последней страницы
		$this->start = $this->active-floor(($this->list_length-1)/2);
		$this->end   = $this->active+ceil (($this->list_length-1)/2);
		// проверка допустимости кнопок слева
		while ($this->start < 1){
			$this->start++; // убираем лишнюю кнопку слева
			// добавляем кнопку справа, если есть
			if ($this->end+1 < $this->last) $this->end++;
		}
		// проверка допустимости кнопок справа
		while ($this->end > $this->last){
			$this->end--; // убираем лишнюю кнопку справа
			// добавляем кнопку слева, если есть
			if ($this->start-1 > 1) $this->start--;
		}

		// заполнение списка кнопок
		return array_keys(
			array_fill($this->start, $this->end-$this->start+1, '')
		);
	}

	/**
	 * Экспортирует данные модели
	 * 
	 * @return	array
	 */
	public function export(){
		return array(
			'ferst'		=> 1,
			'last'		=> $this->last,
			'previous'	=> ($this->active-1 >= 1 ? $this->active-1 : false),
			'next'		=> ($this->active+1 <= $this->last ? $this->active+1 : false),
			'active'	=> $this->active,
			'list'		=> $this->calculateList(),
			'variable'	=> $this->variable,
		);
	}

}