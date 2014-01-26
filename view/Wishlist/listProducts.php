
<select onchange="reloadWithCategory(this.value)">
    <option value="0">Toate</option>
    <?php
        foreach ($data['categories'] AS $categoryRow) {
            ?>
            <option value="<?=$categoryRow->getId()?>" <?=($data['category']->getId() == $categoryRow->getId() ? 'selected' : '')?>><?=$categoryRow->getName()?></option>
            <?php
        }
    ?>
</select>

<form method="POST" action="<?=$baseDir?>Wishlist/saveProductsToList/">
    <input type="submit" value="Salveaza produse">

    <?php
    $i = 1;
    foreach ($data['products'] AS $product) {
        ?>
        <div id="product_<?=$i?>" <?=($i > 10 ? 'style="display:none"' : '')?>>
            Nume: <?=$product->getName()?><br>
            Pret: <?=$product->getPrice()?>
            <br>
            <img src="<?=$baseDirImages?><?=$product->getImage()?>">
            <input type="checkbox" name="products[]" id="product_<?=$product->getId()?>" value="<?=$product->getId()?>">
            <input type="text" name="product_price_<?=$product->getId()?>" id="product_price_<?=$product->getId()?>">
            <hr>
        </div>
        <?php
        $i++;
    }
    ?>
    <a href="javascript:void(0)" onclick="loadMore()">Mai multe</a>
    <input type="hidden" name="listId" id="listId" value="<?=$data['listId']?>">
</form>

<script type="text/javascript">
    var start = 10;

    function loadMore() {
        var end = start + 10;
        for (var i = start ; i < end; i++) {
            document.getElementById('product_' + i).style.display = 'block';
        }
        start += 10;
    }

    function reloadWithCategory(categoryId) {
        window.location = "<?=$baseDir?>Wishlist/listProducts/?listId=<?=$data['listId']?>&categoryId=" + categoryId;
    }
</script>