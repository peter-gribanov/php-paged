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
	// добавляет ссылки на следующую и предыдущую страницу
	$view = Facade::setView($view, 'PreviousNext');
	// добавляет ссылки на первую и последнюю страницу
	$view = Facade::setView($view, 'FerstLast');
	// отображает результат в списке ul, li
	$view = Facade::setView($view, 'List');
	// кэшируем вывод. обработка данных и отработка шаблона выполняется только один раз
	// повторные вызовы вывода данных будут возвращать данные из кэша
	$view = Facade::setView($view, 'Cache');

	// отрисовываем меню
	$view->showPack();

} catch (Exception $e){ // обработчик ошибок
	exit('Error: '.$e->getMessage());
}

/**
 * Результат выполнения
 * 
 * <ul>
 * 	<li><span>Первая</span></li>
 * 	<li><span>Предыдущая</span></li>
 * 	<li><span>1</span></li>
 * 	<li><a href="http://paged/?p=2" title="Страница 2">2</a></li>
 * 	<li><a href="http://paged/?p=3" title="Страница 3">3</a></li>
 * 	<li><a href="http://paged/?p=4" title="Страница 4">4</a></li>
 * 	<li><a href="http://paged/?p=5" title="Страница 5">5</a></li>
 * 	<li><a href="http://paged/?p=2" title="Следующая страница">Следующая</a></li>
 * 	<li><a href="http://paged/?p=15" title="Последняя страница">Последняя</a></li>
 * </ul>
 */
