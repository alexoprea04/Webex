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
	<form method="post" action="/Recurrent/saveItem/">
		<div>Nume lista:</div>
		<div><input type="text" name="name" /></div>
		<div>Scurta descriere:</div>
		<div><input type="textarea" name="description" /></div>
		<div>Interval zile:</div>
		<div>
			<select name="days">
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="14">14</option>
				<option value="30">30</option>
			</select>
		</div>
		<div>
			<input type="submit" value="Salveaza" style="background-color: #993300;" />
		</div>
	</form>
</div>
<?php
require_once ('view/footer.php');
?>