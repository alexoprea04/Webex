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
	<table style="width: 100%" cellpadding="3" cellspacing="3">
    <?php
	$totalPage = 0;
    foreach ($data['products'] AS $product) {
        ?>
        <tr>
			<td align="left" valign="top" colspan="2" style="font-size: 1.2em;"><?=$product['productObject']->getName()?></td>
		</tr>
        <tr style="background-color: #A3A3A3;">
			<td align="left" valign="top">Pret</td>
			<td align="right" valign="top"><?=$product['productQuantity']?> x <?=$product['productObject']->getPrice()?> RON</td>
		</tr>
		<?php
		$totalPage += $product['productQuantity'] * $product['productObject']->getPrice();
		?>
    <?php
    }
    ?>
        <tr>
			<td align="left" style="font-size: 1.4em;"><b>Total</b></td>
			<td align="right" style="font-size: 1.4em;"><?php echo number_format($totalPage, 2, ',', '.');?> RON</td>
		</tr>	
	</table>
<form method="POST" action="/Recurrent/buyOk/">
	<input type="hidden" name="listId" value="<?=$data['list']->getId()?>" />
    <input type="submit" value="Cumpara acum" style="width: 100%; background-color: #408500; color: #FFF; font-weight: bold; height: 35px; border-radius: 10px;">
</form>	
</div>
<?php
require_once ('view/footer.php');
?>