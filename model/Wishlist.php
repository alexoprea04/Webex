<?php

class Wishlist_Model extends Base_Model {

    const TABLE = 'wishlists';
    const TABLE_PRODUCTS = 'wishlist_products';

    private $id;
    private $userId;
    private $name;
    private $description;
    private $status;
    private $createdAt;
    private $modifiedAt;

    public function fetchProducts() {
        $conn = DBConnection::getConnection();
        $sql = 'SELECT *
                    FROM ' . self::TABLE_PRODUCTS . '
                    WHERE  status > 0';
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result AS $row) {
            $objects[] = Products_Model::fetchById($row['product_id']);
        }

        return $objects;
    }


    public function addProduct($productId, $productPrice) {
        $conn = DBConnection::getConnection();
        $sql = 'INSERT INTO ' . self::TABLE_PRODUCTS . ' (
                        wishlist_id,
                        product_id,
                        product_price,
                        product_target_price,
                        created_at
                    )
                    SELECT
                            ' . $this->getId() . ',
                            p.id,
                            p.price,
                            ' . $productPrice . ',
                            NOW()
                        FROM ' . Products_Model::TABLE . ' AS p
                        WHERE p.id = ' . $productId . '
                    ';
        $query = $conn->prepare($sql);
        $query->execute();

        return true;
    }

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

    public static function fetchAll() {
        $conn = DBConnection::getConnection();
        $sql = 'SELECT *
                    FROM ' . self::TABLE . '
                    WHERE  status > 0';
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result AS $row) {
            $objects[] = self::arrayToClassObject($row);
        }

        return $objects;
    }

    private static function arrayToClassObject(array $array) {
        $obj = new self();
        $obj->setId($array['id']);
        $obj->setName($array['name']);
        $obj->setDescription($array['description']);
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
                    `status`,
                    `created_at`
                    ) VALUES (
                        '" . $this->getUserId() . "',
                        '" . $this->getName() . "',
                        '" . $this->getDescription() . "',
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

    public static function fetchByUserId($userId) {
        return self::fetchBy(' user_id = ' . (int)$userId);
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

}