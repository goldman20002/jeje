<?php

header("Content-type: image/svg+xml");

function svg() {
	return <<< EOF
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	
		<!--<script>
			function move() {
				document.getElementById('line').setAttribute('y2',500);
			}
		</script>-->
		
		<script xlink:href="interface2.js"/>
		
		<!--<rect onmouseover="alert('coucou')" fill="red" x="100" y="100" width="100" height="100"></rect>-->
		<!--<rect onmouseover="document.getElementById('line').setAttribute('y2',500);" fill="red" x="100" y="100" width="100" height="100"></rect>-->
		<rect onmouseover="move()" fill="red" x="100" y="100" width="100" height="100"></rect>
EOF;
}

echo svg();

for($i=0;$i<50;$i++) {
	$x = rand(0, (50*$i));
	$y = rand(0, 50);
	
	 if ($i%2 == 0)
    {
		$color = "green";
    }
    else
    {
		$color = "red";
    }
    
	echo '<line id="line'.$i.'" x1="'.$x.'" y1="'.$y.'" x2="300" y2="100" stroke="'.$color.'" stroke-width="5"  />';
}

echo "</svg>";

?>