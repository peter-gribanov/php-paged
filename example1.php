<?php

include 'PagedNumbers.php';

// составление 
$paged = PagedNumbers::create(10);

if (isset($_GET['page']))
	$paged->setActive($_GET['page']);


// список страниц
foreach($paged->getList() as $num){
	// это активная страница
	if($num==$paged->getActive()){
		echo '<span>'.$num.'</span>'."\n";
	} else {
		echo '<a href="?page='.$num.'" title="Page '.$num.'">'.$num.'</a>'."\n";
	}
}

?>
Результат работы:
<span>1</span>
<a href="?page=2" title="Page 2">2</a>
<a href="?page=3" title="Page 3">3</a>
<a href="?page=4" title="Page 4">4</a>
<a href="?page=5" title="Page 5">5</a>
<a href="?page=6" title="Page 6">6</a>
<a href="?page=7" title="Page 7">7</a>
<a href="?page=8" title="Page 8">8</a>
<a href="?page=9" title="Page 9">9</a>
<a href="?page=10" title="Page 10">10</a>