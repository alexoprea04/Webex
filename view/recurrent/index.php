<?php
require_once ('view/header.php');
?>
<div>
	<div id="display-nolist" style="display: <?php echo $data['display-nolist'];?>">
		In acest moment nu ai nicio lista selectata<br />
		<a href="/Recurrent/createList">Creaza o noua lista</a>
		<ul>
			<li>Cumperi automat bla bla bla</li>
			<li>Alt bla bla</li>
		</ul>
	</div>
	<div id="display-list" style="display: <?php echo $data['display-list'];?>">
		<?php
			foreach($data['lists'] as $list) {
				?>
					<div style="background: <?php echo (strtotime($list['next_shopping_date']) < time())?'red':'white'; ?>">
						<div><?php echo $list["name"]; ?></div>
						<div><?php echo $list["description"]; ?></div>
						<div><?php echo $list["produse"]; ?> produse</div>
					</div>
				<?php
			}
		?>
		<div><a href="/Recurrent/createList" style="color: black;">Creeaza o noua lista</a></div>
	</div>
</div>
<?php
require_once ('view/footer.php');
?>