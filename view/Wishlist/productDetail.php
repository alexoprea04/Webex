<div>
    Lista: <?=$data['list']->getName()?>
    Nume: <?=$data['product']->getName()?><br>
    Pret: <?=$data['product']->getPrice()?>
    <br>
    <img src="<?=$baseDirImages?><?=$data['product']->getImage()?>">
    <a href=""></a>
</div>