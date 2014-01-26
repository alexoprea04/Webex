<?php
require_once ('view/header.php');
?>
	<div class="header">
		<div class="buttons">
			<div class="home">
				<a href="/Home/index"><img src="/images/home.jpeg" alt="home" width='49px' height='40'>
				</a>
			</div>
			<div class="title"><h1>Produsul zilei</h1></div>
			<div class="menu">
				<a href="/Settings/index"><img src="/images/menu.png" alt="menu"></a>
			</div>
			
		</div>
	</div>
	<div style="padding: 10px;">
		<?php
			foreach($data as $product)
			{
		?>
			<h1 style="font-size: 1.4em; color: #8c8c8c"><?=$product['name']?></h1>
			<div><i><?=$product['cname']?></i></div>
			<div style="font-size: 1.2em; color: #408500">Pret: <?=$product['price']?> RON</div>
			<div style="margin-top: 20px;">
				<div style="float: right">
					<img src="/external/product_images/<?=$product['image']?>" style="padding: 3px solid #FFFFFF; border: 1px solid #999999">
				</div>
				<div>
					<div><a href="/Buy/product?id=<?=$product['id']?>" class="buy-button">Cumpara</a></div>
					<div><a href="/Wishlist/addItem" class="wish-button">Adauga la wishlist</a></div>
					<div><a href="/Recurrent/createList" class="list-button">Lista recurenta</a></div>
				</div>
			</div>
			<div style="clear :both">
				<b>Descriere</b><br />
				<hr />
				<div class="description"><?=$product['description']?></div>
			</div>
		<?php
			}
		?>
	</div>

<?
require_once ('view/footer.php');