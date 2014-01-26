<?php

class Recurrent_Model extends Base_Model {

    const TABLE = 'reccurent_lists';
    const TABLE_PRODUCTS = 'reccurent_products';

    private $id;
    private $userId;
    private $name;
    private $description;
    private $nextShoppingDate;
    private $lastShoppingDate;
    private $shoppingInterval;
    private $status;
    private $createdAt;
    private $modifiedAt;

    private static function fetchBy($cond) {
        $conn = DBConnection::getConnection();
        $sql = 'SELECT *
                    FROM ' . self::TABLE . '
                    WHERE ' . $cond . '
                        AND status > 0
                    LIMIT 1';
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return self::arrayToClassObject($result[0]);
    }

    public function fetchAll() {
        $conn = DBConnection::getConnection();
        $sql = 'SELECT *
                    FROM ' . self::TABLE . '
                    WHERE  status > 0';
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result AS $row) {
            $objects[] = $this->arrayToClassObject($row[0]);
        }

        return $objects;
    }

    private static function arrayToClassObject(array $array) {
        $obj = new self;
        $obj->setId($array['id']);
        $obj->setName($array['name']);
        $obj->setDescription($array['description']);
        $obj->setNextShoppingDate($array['description']);
        $obj->setLastShoppingDate($array['description']);
        $obj->setShoppingInterval($array['description']);
        $obj->setStatus($array['status']);
        $obj->setUserId($array['user_id']);
        $obj->setCreatedAt($array['created_at']);
        $obj->setModifiedAt($array['modified_at']);

        return $obj;
    }

    public function save() {
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO " . self::TABLE . "
                (
                    `user_id`,
                    `name`,
                    `description`,
                    `next_shopping_date`,
                    `last_shopping_date`,
                    `shopping_interval`,
                    `status`,
                    `created_at`
                    ) VALUES (
                        '" . $this->getUserId() . "',
                        '" . $this->getName() . "',
                        '" . $this->getDescription() . "',
                        '" . $this->getNextShoppingDate() . "',
                        '" . $this->getLastShoppingDate() . "',
                        '" . $this->getShoppingInterval() . "',
                        '" . $this->getStatus() . "',
                        NOW()
                    )";

        $query = $conn->prepare($sql);
        $query->execute();
        $id = $conn->lastInsertId();
        $this->setId($id);

        return $this;
    }

    public static function fetchById($id) {
        return self::fetchBy(' id = ' . (int)$id);
    }

    public function fetchByUserId($userId) {
        return $this->fetchBy(' user_id = ' . (int)$userId);
    }

    public function setModifiedAt($modifiedAt) {
        $this->modifiedAt = $modifiedAt;
    }
    public function getModifiedAt() {
        return $this->modifiedAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }
    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    public function getStatus() {
        return $this->status;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setNextShoppingDate($nextShoppingDate) {
        $this->nextShoppingDate = $nextShoppingDate;
    }
    public function getNextShoppingDate() {
        return $this->nextShoppingDate;
    }

    public function setLastShoppingDate($lastShoppingDate) {
        $this->lastShoppingDate = $lastShoppingDate;
    }
    public function getLastShoppingDate() {
        return $this->lastShoppingDate;
    }
	
    public function setShoppingInterval($shoppingInterval) {
        $this->shoppingInterval = $shoppingInterval;
    }
    public function getShoppingInterval() {
        return $this->shoppingInterval;
    }
	
    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function getUserId() {
        return $this->userId;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function fetchProducts() {
        $conn = DBConnection::getConnection();
        $sql = 'SELECT *
                    FROM ' . self::TABLE_PRODUCTS . '
                    WHERE reccurent_list_id = ' . $this->getId() . '
        ';
		
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $objects = array();
        foreach ($result AS $row) {
            $objects[] = array(
                    'productObject' => Products_Model::fetchById($row['product_id']),
                    'productQuantity' =>$row['product_quantity']
            );
        }

        return $objects;
    }	
	
    public function removeAllProducts() {
        $conn = DBConnection::getConnection();
        $sql = 'DELETE
                    FROM ' . self::TABLE_PRODUCTS . '
                    WHERE reccurent_list_id = ' . $this->getId() . '
        ';

        $query = $conn->prepare($sql);
        $query->execute();
    }
	
    public function addProduct($productId, $productQuantity) {
        $conn = DBConnection::getConnection();
        $sql = 'INSERT INTO ' . self::TABLE_PRODUCTS . ' (
                        reccurent_list_id,
                        product_id,
                        product_quantity
                    )
                    SELECT
                            ' . $this->getId() . ',
                            p.id,
                            ' . $productQuantity . '
                        FROM ' . Products_Model::TABLE . ' AS p
                        WHERE p.id = ' . $productId . '
                    ';
		
        $query = $conn->prepare($sql);
        $query->execute();

        return true;
    }
	
	
    public function postpone() {
        $conn = DBConnection::getConnection();
        $sql = 'UPDATE ' . self::TABLE . '  SET next_shopping_date = next_shopping_date + 1 WHERE id = ' . $this->getId() . '';
		
        $query = $conn->prepare($sql);
        $query->execute();

        return true;
    }
}