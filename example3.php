<?php
include 'PagedLinks.php';

try {
	// составление 
	$paged = PagedLinks::create(10, 'p')
		// длинна списка страниц
		->setListLength(5);

} catch (Exception $e){
	// при составлении структуры допущена ошибка
	exit('<p><strong>Error: '.$e->getMessage().'</strong></p>');
}



// список страниц не пустой
if (!$paged->isEmptyList()){

	// предыдущая страница
	if(!$paged->isVisible($paged->getFirst())){
		echo "<a href=\"".$paged->getFirstLink()."\" title=\"First page\">"
			.$paged->getFirst()."</a>\n...\n";
	}

	// список страниц
	foreach($paged->getListLinks() as $num=>$link){
		// это активная страница
		if($num==$paged->getActive()){
			echo "<span>".$num."</span>\n";
		} else {
			echo "<a href=\"".$link."\" title=\"Page ".$num."\">".$num."</a>\n";
		}
	}

	// следующая страница
	if(!$paged->isVisible($paged->getLast())){
		echo "...\n<a href=\"".$paged->getLastLink()."\" title=\"Last page\">"
			.$paged->getLast()."</a>\n";
	}
}
?>
Результат работы:
﻿<span>1</span>
<a href="http://paged/example3.php?p=2" title="Page 2">2</a>
<a href="http://paged/example3.php?p=3" title="Page 3">3</a>
<a href="http://paged/example3.php?p=4" title="Page 4">4</a>
<a href="http://paged/example3.php?p=5" title="Page 5">5</a>
...
<a href="http://paged/example3.php?p=10" title="Last page">10</a>