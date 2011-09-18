<?php
use Paged\Facade;

require_once 'Facade.php';

try {

	// устанавливаем язык
	Facade::setLangID('ru');

	// инициализируем
	$menu = Facade::getMenu()
		// указываем длину списка
		->setListLength(5)
		// указываем название переменной
		->setVariable('p')
		// указываем номер последней страницы
		->setLast(15);

	// приводит ссылки к абсолютным
	$view = Facade::setView($menu, 'Links');
	// отображает результат в списке ul, li
	$view = Facade::setView($view, 'List');

	// отрисовываем меню
	$view->showPack();

} catch (Exception $e){ // обработчик ошибок
	exit('Error: '.$e->getMessage());
}

/**
 * Результат выполнения
 * 
 * <ul>
 * 	<li><span>1</span></li>
 * 	<li><a href="http://mydomain/?p=2" title="Страница 2">2</a></li>
 * 	<li><a href="http://mydomain/?p=3" title="Страница 3">3</a></li>
 * 	<li><a href="http://mydomain/?p=4" title="Страница 4">4</a></li>
 * 	<li><a href="http://mydomain/?p=5" title="Страница 5">5</a></li>
 * </ul>
 */
