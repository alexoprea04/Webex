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
			<div align="center" style="margin-top: 50px">
				Happy ;)<br /><br />
				Felicitari, tocmai ai achizitionat produsul<br /><br /> 
				<?=$product['name']?>.
			</div>
		<?php
			}
		?>
	</div>

<?
require_once ('view/footer.php');