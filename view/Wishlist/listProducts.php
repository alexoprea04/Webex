
<form method="POST" action="<?=$baseDir?>Wishlist/saveProductsToList/">
    <input type="submit" value="Salveaza produse">

    <?php
        foreach ($data['products'] AS $product) {
            ?>
                <div>
                    Nume: <?=$product->getName()?><br>
                    Pret: <?=$product->getPrice()?>
                    <br>
                    <img src="<?=$baseDirImages?><?=$product->getImage()?>">
                    <input type="checkbox" name="products[]" id="product_<?=$product->getId()?>" value="<?=$product->getId()?>">
                    <input type="text" name="product_price_<?=$product->getId()?>" id="product_price_<?=$product->getId()?>">
                </div>
                <hr>

            <?php
        }
    ?>
    <input type="hidden" name="listId" id="listId" value="<?=$data['listId']?>">
</form>