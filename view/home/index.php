<?php
require_once ('view/header.php');
?>
	<div class="header">
		<div class="buttons">
			<div class="home">
				<a href="/Home/index"><img src="../../prologue/images/home.jpeg" alt="home" width='49px' height='40'>
				</a>
			</div>
			<div class="title"><h1>Wx Alerts</h1></div>
			<div class="menu">
				<a href="#"><img src="../../prologue/images/menu.png" alt="menu"></a>
			</div>
			
		</div>
	</div>
	<div class="main">
	<ul>
		<li>
			<a href="/Wishlist/addItem"><img src="../../prologue/images/avatar.png" alt="alerta" class="icons"><p>Alerta produs</p></a>
			<img src="../../prologue/images/next.png" alt="next"class="next">
		</li>
		<li><a href="/Recurrent/index"><img src="../../prologue/images/recurent_shopping.jpg" alt="recurent" class="icons"><p>Cumparaturi recurente</p></a>
			<img src="../../prologue/images/next.png" alt="next" class="next">
		</li>
		<li><a href="/Random/index"><img src="../../prologue/images/product_day.png" alt="alerta" class="icons"><p>Produsul zilei</p></a>
			<img src="../../prologue/images/next.png" alt="next" class="next">
		</li>
		<li><a href="/Settings/index">
			<img src="../../prologue/images/setup.png" alt="alerta" class="icons"><p>Setari</p></a>
			<img src="../../prologue/images/next.png" alt="next" class="next">
		</li>
	</ul>
	</div>

<?
require_once ('view/footer.php');