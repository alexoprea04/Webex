<style>
    .main_container_form {
        padding:1em 0 1em 0;
    }
    .main_container_form input[type="text"] {
        width:100%;
    }

    .main_container_form input[type="submit"] {
        height: 3em;
        width:100%;
    }
    .main_container_form input[type="button"] {
        height: 3em;
        width:100%;
    }

    .main_container_form select {
        height: 2em;
        width:100%;
        margin-bottom:1em;
    }
    .main_container_form span {
        margin-bottom:15em;
    }

    .medium_height {
        height:2em;
    }
    .holder-specificatii {
        vertical-align:text-top;
    }
    .box-specificatie {
        width:20em;
        display:inline-block;
        vertical-align:text-top;
    }
    .ch_group {
        font-size:1.3em;
        color: #8c8c8c;
    }
    .ch_title {
        display:inline-block;
        width:48%;
    }
    .ch_spec {
        display:inline-block;
        width:48%;
    }
</style>
<div class="header">
    <div class="buttons">
        <div class="home">
            <a href="/Home/index"><img src="/images/home.jpeg" alt="home" width='49px' height='40'>
            </a>
        </div>
        <div class="title"><h1>Adauga Produse</h1></div>
        <div class="menu">
            <a href="/Wishlist/listItems/"><img src="/images/menu.png" alt="menu"></a>
        </div>

    </div>
</div>
<div class="main main_container_form">
    <form method="POST" action="<?=$baseDir?>Wishlist/saveProductsToList/">
        <?php
        if (count($data['products']) > 0) {
            ?>
            <input type="submit" value="Salveaza produse">
        <?php
        }
        ?>


        <?php
        foreach ($data['products'] AS $product) {
            ?>
            <div id="container_<?=$product['productObject']->getId()?>"  style="border-bottom: 1px dashed #999999;padding-top:1em;padding-bottom:1em;margin-bottom:1em">

                <h2 style="font-size: 1.2em; ">
                    <a href="javascript:void(0)" style="color: #8c8c8c;text-decoration: none" onclick="expandDescription(<?=$product['productObject']->getId()?>)">
                        <?=$product['productObject']->getName()?>
                    </a>
                </h2>
                <h2 style="font-size: 1.1em; color: #408500;margin-bottom:1em;">
                    <?=$product['productObject']->getPrice()?> RON
                </h2>


                <img src="<?=$baseDirImages?><?=$product['productObject']->getImage()?>">
                <br>
                <br>
                Pret <input type="text" style="width:8em" name="product_price_<?=$product['productObject']->getId()?>" id="product_price_<?=$product['productObject']->getId()?>" value="<?=$product['target_price']?>"> RON
                <input type="hidden" name="products[]" value="<?=$product['productObject']->getId()?>">
                <a href="javascript:void();" style="margin-left:1.3em;" onclick="removeProductContainer(<?=$product['productObject']->getId()?>)">Sterge</a>

            </div>


        <?php
        }
        ?>
        <input type="hidden" name="listId" id="listId" value="<?=$data['list']->getId()?>">

        <a href="<?=$baseDir?>/Wishlist/listProducts/?listId=<?=$data['list']->getId()?>" style="text-decoration: none"><input type="button" value="Adauga produse"></a>
    </form>
</div>
<script>
    function removeProductContainer(productId) {
        document.getElementById('container_' + productId).remove();
    }

</script>