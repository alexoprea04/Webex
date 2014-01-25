<?php

	//var_dump($data);
	
?>
<?php
require_once ('view/header.php');
?>
<div>
	<div id="display-nolist" style="display: <?php echo $data['display-nolist'];?>">
		In acest moment nu ai nicio lista selectata<br />
		<a href="/Recurrent/createList">Creaza o lista</a>
		<ul>
			<li>Cumperi automat bla bla bla</li>
			<li>Alt bla bla</li>
		</ul>
	</div>
	<div id="display-list" style="display: <?php echo $data['display-list'];?>">
		
	</div>
</div>
<?php
require_once ('view/footer.php');
?>