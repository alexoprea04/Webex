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
            <a href="/Recurrent/index/"><img src="/images/menu.png" alt="menu"></a>
        </div>

    </div>
</div>
<div class="main main_container_form">
    <select onchange="reloadWithCategory(this.value)" class="ui-corner-all">
        <option value="0">Toate</option>
        <?php
            foreach ($data['categories'] AS $categoryRow) {
                ?>
                <option value="<?=$categoryRow->getId()?>" <?=($data['category']->getId() == $categoryRow->getId() ? 'selected' : '')?>><?=$categoryRow->getName()?></option>
                <?php
            }
        ?>
    </select>

    <form method="POST" action="/Recurrent/saveProductsToList/">
        <input type="submit" value="Salveaza produse">
    <br>
    <br>
        <?php
        $i = 1;
        foreach ($data['products'] AS $product) {
            ?>
            <div id="product_<?=$i?>" <?=($i > 10 ? 'style="display:none"' : '')?> style="border-bottom: 1px dashed #999999;padding-top:1em;">
                <h2 style="font-size: 1.2em; ">
                    <a href="javascript:void(0)" style="color: #8c8c8c;text-decoration: none" onclick="expandDescription(<?=$product->getId()?>)">
                        <?=$product->getName()?>
                    </a>
                </h2>

                <h2 style="font-size: 1.1em; color: #408500;margin-bottom:1em;">
                    <?=$product->getPrice()?> RON
                </h2
                <br>
                <a href="javascript:void(0)" style="color: #8c8c8c;text-decoration: none" onclick="expandDescription(<?=$product->getId()?>)">
                    <img src="<?=$baseDirImages?><?=$product->getImage()?>">
                </a>
                <br>
                <input type="checkbox" name="products[]"
                       id="product_<?=$product->getId()?>"
                       onclick="document.getElementById('product_quantity_container_' + <?=$product->getId()?>).style.display = 'inline';"
                       value="<?=$product->getId()?>" style="width:1.5em;height:1.5em;">

                <span id="product_quantity_container_<?=$product->getId()?>" style="display: none;margin-top:1em;">
                    <br>
                    Cantitate <input type="text" name="product_quantity_<?=$product->getId()?>" id="product_quantity_<?=$product->getId()?>" style="width:10em;padding-top:0px;margin-top:0px;">
                </span>
                <br>
                <br>
                <span id="product_description_<?=$product->getId()?>" style="display:none"><?=$product->getDescription()?></span>


            </div>
            <?php
            $i++;
        }
        ?>
        <input type="button" onclick="loadMore()" value="Mai multe" style="margin:1em 0 2em">
        <input type="hidden" name="listId" id="listId" value="<?=$data['listId']?>">
    </form>
</div>

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
        window.location = "/Recurrent/searchProducts/?listId=<?=$data['listId']?>&categoryId=" + categoryId;
    }

    function expandDescription(productId) {
        var el = document.getElementById('product_description_' + productId);

        if (el.style.display == 'block') {
            el.style.display = 'none';
        } else if (el.style.display == 'none') {
            el.style.display = 'block';
        }
    }
</script>