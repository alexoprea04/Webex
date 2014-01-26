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
        $sql = 'SELECT *
                    FROM ' . self::TABLE . '
                    WHERE ' . $cond . '
                        AND status > 0
                    LIMIT 1';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $this->arrayToClassObject($result[0]);
    }

    public function fetchAll() {
        $sql = 'SELECT *
                    FROM ' . self::TABLE . '
                    WHERE  status > 0';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result AS $row) {
            $objects[] = $this->arrayToClassObject($result[0]);
        }

        return $objects;
    }

    private function arrayToClassObject(array $array) {
        $this->setId($array['id']);
        $this->setName($array['name']);
        $this->setDescription($array['description']);
        $this->setNextShoppingDate($array['description']);
        $this->setLastShoppingDate($array['description']);
        $this->setShoppingInterval($array['description']);
        $this->setStatus($array['status']);
        $this->setUserId($array['user_id']);
        $this->setCreatedAt($array['created_at']);
        $this->setModifiedAt($array['modified_at']);

        return $this;
    }

    public function save() {
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

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchById($id) {
        return $this->fetchBy(' id = ' . (int)$id);
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
                    WHERE list_id = ' . $this->getId() . '
        ';

        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $objects = array();
        foreach ($result AS $row) {
            $objects[] = array(
                    'productObject' => Products_Model::fetchById($row['product_id']),
                    'target_price' => $row['product_target_price']
            );
        }

        return $objects;
    }	
	
    public function removeAllProducts() {
        $conn = DBConnection::getConnection();
        $sql = 'DELETE
                    FROM ' . self::TABLE_PRODUCTS . '
                    WHERE id = ' . $this->getId() . '
        ';

        $query = $conn->prepare($sql);
        $query->execute();
    }
	
    public function addProduct($productId, $productPrice) {
        $conn = DBConnection::getConnection();
        $sql = '';
        $query = $conn->prepare($sql);
        $query->execute();

        return true;
    }
}