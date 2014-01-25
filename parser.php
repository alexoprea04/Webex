<?php
ini_set('display_errors', false);

$user = 'root';
$pass ='';
$db = new PDO('mysql:host=192.168.12.227;dbname=application;charset=utf8', $user , $pass);

$imagesDestFolder = 'C:\Users\cosmin.milea\Documents\GitHub\Webex\external\product_images';



$url = 'http://www.emag.ro/procesoare/p2/c';
$categoryId = 6;



$doc = new DOMDocument();
$doc->loadHTMLFile($url);

$xpath = new DOMXpath($doc);

// example 1: for everything with an id
//$elements = $xpath->query("//*[@id]");

// example 2: for node data in a selected id
//$elements = $xpath->query("*/form[@action='https://www.emag.ro/addtocart']");

// example 3: same as above with wildcard
$elements = $xpath->query("//form[@action='https://www.emag.ro/addtocart']");

if (!is_null($elements)) {
    foreach ($elements as $element) {
        //echo "<br/>[". $element->nodeName. "]";
        $productContent = get_inner_html($element);

        $productObj = new DOMDocument();
        $productObj->loadHTML($productContent);

        $xpath = new DOMXpath($productObj);
        $pElements = $xpath->query("//img");
        foreach ($pElements AS $k) {
            $imageSrc = $k->getAttribute('src');
        }

        if (basename($imageSrc) == 'bulina_listing.png') {
            continue;
        }

        $pElements = $xpath->query("//a/span");
        foreach ($pElements AS $k) {
            $title = $k->parentNode->getAttribute('title');
            $productUrl = $k->parentNode->getAttribute('href');
        }

        $pElements = $xpath->query("//span[@class='price-over']");
        foreach ($pElements AS $k) {
            $price = (int)str_replace('.', '', str_replace('Lei', '', $k->nodeValue)) / 100;
        }


        echo 'title: ' . $title .
            '<br> price: ' . $price .
            '<br> image: ' . $imageSrc .
            '<br> url: ' . $productUrl . '<br><br><br> ';

        //next.. the product page

        $detailUrl = 'http://www.emag.ro' . $productUrl;
        $detailDoc = new DOMDocument();
        $detailDoc->loadHTMLFile($detailUrl);

        $detailXpath = new DOMXpath($detailDoc);
        $detailElements = $detailXpath->query("//div[@class='holder-specificatii']");


        foreach ($detailElements AS $spec) {
            $specsHtml = '<div class="holder-specificatii">' . get_inner_html($spec) . '</div>';
        }

         //time to insert
        insert($title, $price, $imageSrc, $specsHtml);



    }
}


function insert($title, $price, $imageSrc, $specsHtml) {

    global $db, $imagesDestFolder, $categoryId;

    //copy image to local
    try {
        echo basename($imageSrc);

        $imageDest = $imagesDestFolder .'\\' . basename($imageSrc);
        copy($imageSrc, $imageDest);
        echo $imageDest;
    }catch(Exception $exc) {
        var_dump($exc);
    };

    try {
        $sql = "
        INSERT INTO `products` (
                `category_id`,
                `name`,
                `description`,
                `price`,
                `currency`,
                `status`,
                `image`
            ) VALUES (
                '" . $categoryId . "',
                '" . $title . "',
                '" . $specsHtml . "',
                '" . $price . "',
                '1',
                '1',
                '". basename($imageSrc) ."'
            )
    ";

    $query = $db->prepare($sql);

    $query->execute();
    $product = $query->fetchAll(PDO::FETCH_ASSOC);

    }catch(Exception $exc) {
        var_dump($exc);
    };
}

function get_inner_html( $node ) {
    $innerHTML= '';
    $children = $node->childNodes;
    foreach ($children as $child) {
        $innerHTML .= $child->ownerDocument->saveXML( $child );
    }

    return $innerHTML;  }