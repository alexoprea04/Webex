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
<form method="POST" action="<?=$baseDir?>Recurrent/saveProductsToList/">
    <input type="submit" value="Salveaza produse">

    <?php
    foreach ($data['products'] AS $product) {
        ?>
        <div id="container_<?=$product['productObject']->getId()?>">
            Nume: <?=$product['productObject']->getName()?><br>
            Pret: <?=$product['productObject']->getPrice()?>
            <br>
            <img src="<?=$baseDirImages?><?=$product['productObject']->getImage()?>">

            <input type="text" name="product_price_<?=$product['productObject']->getId()?>" id="product_price_<?=$product['productObject']->getId()?>" value="<?=$product['target_price']?>">
            <input type="hidden" name="products[]" value="<?=$product['productObject']->getId()?>">
            <a href="javascript:void();" onclick="removeProductContainer(<?=$product['productObject']->getId()?>)">remove</a>
            <hr>
        </div>


    <?php
    }
    ?>
    <input type="hidden" name="listId" id="listId" value="<?=$data['list']->getId()?>">
</form>
<script>
    function removeProductContainer(productId) {
        document.getElementById('container_' + productId).remove();
    }

</script>
</div>
<?php
require_once ('view/footer.php');
?>