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
<form method="POST" action="<?=$baseDir?>Recurrent/postponeOneDay/">
	<input type="hidden" name="listId" value="<?=$data['list']->getId()?>" />
    <input type="submit" value="Amana cu o zi" style="width: 100%;">
</form>	
<form method="POST" action="<?=$baseDir?>Recurrent/saveProductsToList/">
    <input type="submit" value="Salveaza produse" style="width: 100%;">

    <?php
    foreach ($data['products'] AS $product) {
        ?>
        <div id="container_<?=$product['productObject']->getId()?>">
            Nume: <?=$product['productObject']->getName()?><br>
            Pret: <?=$product['productObject']->getPrice()?>
            <br>
            <img src="/external/product_images/<?=$product['productObject']->getImage()?>">

            Cantitate: <input type="text" name="product_quantity_<?=$product['productObject']->getId()?>" id="product_quantity_<?=$product['productObject']->getId()?>" value="<?=$product['productQuantity']?>">
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