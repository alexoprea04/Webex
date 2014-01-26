<a href="<?=$baseDir?>/Wishlist/addItem/">Adauga Lista</a>
<hr>
<?php
foreach($data['lists'] AS $list) {
    ?>
    <a href="<?=$baseDir?>Wishlist/listProductsForList/?listId=<?=$list->getId()?>">
        <?=$list->getName()?> (<?=$list->fetchNumberOfProducts()?>)
    </a>
    <br>
        <?=$list->getDescription()?>
    <hr>
    <?php
}
?>