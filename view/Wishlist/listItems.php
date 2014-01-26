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
    .main_container_form span {
        margin-bottom:15em;
    }

    .medium_height {
        height:2em;
    }
</style>
<div class="header">
    <div class="buttons">
        <div class="home">
            <a href="/Home/index"><img src="/images/home.jpeg" alt="home" width='49px' height='40'>
            </a>
        </div>
        <div class="title"><h1>Adauga Lista</h1></div>
        <div class="menu">
            <a href="/Wishlist/listItems/"><img src="/images/menu.png" alt="menu"></a>
        </div>

    </div>
</div>
<div class="main main_container_form">
    <ul>
        <li>
            <p>
                <a href="<?=$baseDir?>/Wishlist/addItem/">
                    <input type="button" value="Adauga Lista" style="width:100%;height:3em">
                </a>
            </p>
        </li>

        <?php
        if (isset($data['lists'])) {
            foreach($data['lists'] AS $list) {
                ?>
                <li>
                    <a href="<?=$baseDir?>Wishlist/listProductsForList/?listId=<?=$list->getId()?>">
                        <p>
                            <?=$list->getName()?> (<?=$list->fetchNumberOfProducts()?>)
                            <img src="/images/next.png" alt="next" class="next" style="margin:0;">
                        </p>

                    </a>

                </li>
            <?php
            }
        }
        ?>
    </ul>

</div>