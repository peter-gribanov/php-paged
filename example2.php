<?php
include 'PagedNumbers.php';


try {
	// составление 
	$paged = PagedNumbers::create(10)
		// длинна списка страниц
		->setListLength(5);

	if (isset($_GET['page'])){
		$paged->setActive($_GET['page']);
	}

} catch (Exception $e){
	// при составлении структуры допущена ошибка
	exit('<p><strong>Error: '.$e->getMessage().'</strong></p>');
}



// список страниц не пустой
if (!$paged->isEmptyList()){

	// предыдущая страница
	if($paged->getPrevious()){
		echo "<a href=\"?page=".$paged->getPrevious()."\" title=\"Prev\">Prev</a>\n";
	} else {
		echo "<span>Prev</span>\n";
	}

	// список страниц
	foreach($paged->getList() as $num){
		// это активная страница
		if($num==$paged->getActive()){
			echo "<span>".$num."</span>\n";
		} else {
			echo "<a href=\"?page=".$num."\" title=\"Page ".$num."\">".$num."</a>\n";
		}
	}

	// следующая страница
	if($paged->getNext()){
		echo "<a href=\"?page=".$paged->getNext()."\" title=\"Next\">Next</a>\n";
	} else {
		echo "<span>Next</span>\n";
	}
}
?>
Результат работы:<span>Prev</span>
<span>1</span>
<a href="?page=2" title="Page 2">2</a>
<a href="?page=3" title="Page 3">3</a>
<a href="?page=4" title="Page 4">4</a>
<a href="?page=5" title="Page 5">5</a>
<a href="?page=2" title="Next">Next</a>
