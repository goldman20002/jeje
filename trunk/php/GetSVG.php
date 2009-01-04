<?php
header("Content-type: image/svg+xml");

echo '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<script xlink:href="interface.js" />
<g id="lines">';  
for($i=0;$i<100;$i++){
	srand(time());
	$x1 = rand(0, (100*$i));
	$y1 = rand(0, 100);
	
    if ($i%2 == 0)
    {
		$color = "green";
    }
    else
    {
		$color = "red";
    }
	echo '<line id="line'.$i.'" x1="'.$x1.'" y1="'.$y1.'" x2="300" y2="100" stroke="'.$color.'" stroke-width="5"  />';    
    
}


echo '</g>
<rect onmouseover="move()" fill="red" x="100" y="100" width="100" height="100" />
</svg>';

?>