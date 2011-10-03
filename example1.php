<?php
require 'Paged.php';

try {

	// устанавливаем язык
	Paged::setLangID('ru');

	// инициализируем и указываем номер последней страницы
	$menu = Paged::getMenu()->setLast(15);

	// накладываем базовый вид и отрисовываем меню
	Paged::setView($menu)->showPack();

} catch (Exception $e){ // обработчик ошибок
	exit('Error: '.$e->getMessage());
}
?>
Результат выполнения

<span>1</span>
<a href="?page=2" title="Страница 2">2</a>
<a href="?page=3" title="Страница 3">3</a>
<a href="?page=4" title="Страница 4">4</a>
<a href="?page=5" title="Страница 5">5</a>
<a href="?page=6" title="Страница 6">6</a>
<a href="?page=7" title="Страница 7">7</a>
<a href="?page=8" title="Страница 8">8</a>
<a href="?page=9" title="Страница 9">9</a>
<a href="?page=10" title="Страница 10">10</a>
