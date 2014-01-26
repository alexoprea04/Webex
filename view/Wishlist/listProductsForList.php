
<form method="POST" action="<?=$baseDir?>Wishlist/saveProductsToList/">
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