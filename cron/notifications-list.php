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
    $sql = "SELECT
                rt.*
                FROM " . Recurrent_Model::TABLE . " rt
                WHERE rt.user_id = '" . $user->getId() . "' AND rt.next_shopping_date < '".date('Y-m-d', time())."' AND rt.id NOT IN (SELECT list_id FROM user_notifications WHERE user_id = '" . $user->getId() . "' AND status = 1)
                ";		
				
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	

    foreach($result AS $row) {
        //found something
        $content = 'Lista de cumparaturi ' . $row['name'] . ' trebuie achizitionata. ';
        $sql = 'INSERT INTO user_notifications
                    (
                        user_id,
                        content,
                        status,
						list_id,
						list_type
                    ) VALUES (
                        ' . $user->getId() . ',
                        \'' . $content . '\',
                        1,
						' . $row['id'] . ',
						2
                    )';

        $query = $conn->prepare($sql);
        $query->execute();
    }
}
