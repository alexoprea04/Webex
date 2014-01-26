<?php
require_once ('view/header.php');
?>
	<div class="header">
		<div class="buttons">
			<div class="home">
				<a href="/Home/index"><img src="/images/home.jpeg" alt="home" width='49px' height='40'>
				</a>
			</div>
			<div class="title"><h1>Cumparaturi</h1></div>
			<div class="menu">
				<a href="/Settings/index"><img src="/images/menu.png" alt="menu"></a>
			</div>
			
		</div>
	</div>
	<div class="main">
	<div id="display-nolist" style="display: <?php echo $data['display-nolist'];?>">
		In acest moment nu ai nicio lista selectata<br />
		<a href="/Recurrent/createList">Creaza o noua lista</a>
		<ul>
			<li>Cumperi automat bla bla bla</li>
			<li>Alt bla bla</li>
		</ul>
	</div>
	<div id="display-list" style="display: <?php echo $data['display-list'];?>; margin-top: 10px;">
		<?php
			foreach($data['lists'] as $list) {
				?>
					<a class="wish-list-item" href="/Recurrent/listProducts/?id=<?=$list['id']?>" style="background-color: <?php echo (strtotime($list['next_shopping_date']) < time())?'#F2DCAE':'#FFFFFF'; ?>">
						<?php
						if(strtotime($list['next_shopping_date']) < time())
						{
						?>
							<img src="/images/appointment-reminders-xxl.png" style="float: right;"/>
						<?php
						}
						?>
						<div class="wish-title"><?php echo $list["name"]; ?></div>
						<div class="wish-desc"><?php echo $list["description"]; ?></div>
						<div class="wish-prod">&bull; <?php echo $list["produse"]; ?> produse in lista</div>
						<div class="wish-prod" style="color: <?php echo (strtotime($list['next_shopping_date']) < time())?'#C00000':'#000000'; ?>">&bull; Data urmatoarei achizitii: <?php echo $list['next_shopping_date']; ?></div>
					</a>
				<?php
			}
		?>
		<div><a href="/Recurrent/createList" class="wish-button" style="width: 150px;">Creeaza o noua lista</a></div>
	</div>
</div>
<?php
require_once ('view/footer.php');
?>