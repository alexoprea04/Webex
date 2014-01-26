<?php
// autoinclude not available

set_include_path(__DIR__ . '/../');


require_once('../include/config.php');
require_once('../include/dbConnection.php');

//include all the models
if ($handle = opendir('../model/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != '.' && $entry != '..') {
            require_once('model/' . $entry);
        }
    }
    closedir($handle);
}

//db connection
$conn = DBConnection::getConnection();

//fetch all users
$users = User_Model::fetchAll();

foreach ($users AS $user) {
    //fetch eligible products for notification
    $sql = 'SELECT
                pt.*, wpt.product_price AS old_product_price
                FROM ' . Wishlist_Model::TABLE . ' wt
                 INNER JOIN ' . Wishlist_Model::TABLE_PRODUCTS . ' wpt
                    ON wt.id = wpt.wishlist_id
                 INNER JOIN ' . Products_Model::TABLE . ' pt
                    ON pt.id = wpt.product_id
                        AND pt.price <= wpt.product_target_price
                WHERE wt.user_id = ' . $user->getId() . '
                ';
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($result AS $row) {
        //found something
        $content = 'A scazut pretul de la ' . $row['old_product_price'] . ' la ' . $row['price'] . ' RON pentru ' . $row['name'];
        $sql = 'INSERT INTO user_notifications
                    (
                        user_id,
                        content,
                        status
                    ) VALUES (
                        ' . $user->getId() . ',
                        \'' . $content . '\',
                        1
                    )';

        $query = $conn->prepare($sql);
        $query->execute();
    }
}
