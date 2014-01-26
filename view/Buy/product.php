<?php
require_once ('view/header.php');
?>
	<div class="header">
		<div class="buttons">
			<div class="home">
				<a href="/Home/index"><img src="/images/home.jpeg" alt="home" width='49px' height='40'>
				</a>
			</div>
			<div class="title"><h1>Cumpara</h1></div>
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
			<div>
				<div style="float: left; margin-right: 10px;">
					<img src="/external/product_images/<?=$product['image']?>" style="padding: 3px solid #FFFFFF; border: 1px solid #999999">
				</div>
				<h1 style="font-size: 1em; color: #8c8c8c"><?=$product['name']?></h1>
			</div>
			<div style="font-size: 1.2em; color: #408500">Pret: <?=$product['price']?> RON</div>
			<div style="clear: both;">
				<ul>
					<li><b>Nume:</b> Doe</li>
					<li><b>Prenume:</b> John</li>
					<li><b>Username:</b> jdoe</li>
				</ul>
				<ul>
					<li><b>Email:</b> john.doe@jd.com</li>
					<li><b>Cont:</b> 2132 3123 3213 2131 3123</li>
				</ul>
			</div>
			<div style="margin-top: 20px; align: right;">
				<div>
					<div><a href="/Buy/ok?id=<?=$product['id']?>" class="buy-button">Confirma achizita</a></div>
				</div>
			</div>
		<?php
			}
		?>
	</div>

<?
require_once ('view/footer.php');