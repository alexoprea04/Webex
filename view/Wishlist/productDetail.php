<style>
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
        <div class="title"><h1>Detaliu Produs</h1></div>
        <div class="menu">
            <a href="/Wishlist/listItems/"><img src="/images/menu.png" alt="menu"></a>
        </div>

    </div>
</div>
<div class="main">
    <br>
    <div>
        <span style="color: #8c8c8c;text-decoration: none;font-size:1.4em"><?=$data['product']->getName()?></span>
        <h2 style="font-size: 1.1em; color: #408500;margin-bottom:1em;"> <?=$data['product']->getPrice()?> RON </h2>

        <img src="<?=$baseDirImages?><?=$data['product']->getImage()?>">
        <span>
            <?=$data['product']->getDescription()?>
        </span>

    </div>
</div>

