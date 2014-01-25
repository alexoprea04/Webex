<?php
require_once ('view/header.php');
?>
<div>
	<form method="post" action="">
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