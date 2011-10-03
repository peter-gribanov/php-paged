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
	// отображает результат в списке ul, li
	$view = Paged::setView($view, 'List');

	// отрисовываем меню
	$view->showPack();

} catch (Exception $e){ // обработчик ошибок
	exit('Error: '.$e->getMessage());
}
?>
Результат выполнения
<ul>
	<li><span>1</span></li>
	<li><a href="http://mydomain/?p=2" title="Страница 2">2</a></li>
	<li><a href="http://mydomain/?p=3" title="Страница 3">3</a></li>
	<li><a href="http://mydomain/?p=4" title="Страница 4">4</a></li>
	<li><a href="http://mydomain/?p=5" title="Страница 5">5</a></li>
</ul>