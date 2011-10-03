<?php
require 'Paged.php';

try {

	// устанавливаем язык
	Paged::setLangID('ru');

	// инициализируем
	$menu = Paged::getMenu()
		// указываем номер последней страницы
		->setListLength(5)
		// указываем название переменной
		->setVariable('p')
		// указываем длину списка
		->setLast(15);

	// приводит ссылки к абсолютным
	$view = Paged::setView($menu, 'Links');
	// добавляет ссылки на следующую и предыдущую страницу
	$view = Paged::setView($view, 'PreviousNext');
	// добавляет ссылки на первую и последнюю страницу
	$view = Paged::setView($view, 'FerstLast');
	// отображает результат в списке ul, li
	$view = Paged::setView($view, 'List');
	// кэшируем вывод. обработка данных и отработка шаблона выполняется только один раз
	// повторные вызовы вывода данных будут возвращать данные из кэша
	$view = Paged::setView($view, 'Cache');

	// отрисовываем меню
	$view->showPack();

} catch (Exception $e){ // обработчик ошибок
	exit('Error: '.$e->getMessage());
}

?>
Результат выполнения
<ul>
	<li><span>Первая</span></li>
	<li><span>Предыдущая</span></li>
	<li><span>1</span></li>
	<li><a href="http://paged/?p=2" title="Страница 2">2</a></li>
	<li><a href="http://paged/?p=3" title="Страница 3">3</a></li>
	<li><a href="http://paged/?p=4" title="Страница 4">4</a></li>
	<li><a href="http://paged/?p=5" title="Страница 5">5</a></li>
	<li><a href="http://paged/?p=2" title="Следующая страница">Следующая</a></li>
	<li><a href="http://paged/?p=15" title="Последняя страница">Последняя</a></li>
</ul>