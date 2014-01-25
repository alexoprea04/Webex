<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexandru.oprea
 * Date: 25.01.2014
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */
$user = 'root';
$pass ='';
$db = new PDO('mysql:host=192.168.12.227;dbname=application;charset=utf8', $user , $pass);
$random = $db->prepare(
    "
    SELECT products.id
    FROM products
        INNER JOIN (SELECT RAND()*(SELECT MAX(products.id) FROM products) AS ID) AS t ON products.id >= t.ID
    WHERE products.status>0
    ORDER BY products.id
    LIMIT 1;
    ");
$random->execute();
$product = $random->fetchAll(PDO::FETCH_ASSOC);
print_r($product);
?>
