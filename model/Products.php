<?php
class Products_Model extends Base_Model {

    const TABLE = 'products';

    private $id;
    private $categoryId;
    private $name;
    private $model;
    private $description;
    private $price;
    private $image;
    private $currency;
    private $status;
    private $createdAt;
    private $modifiedAt;

    private function arrayToClassObject(array $array) {
        $obj = new self();
        $obj->setId($array['id']);
        $obj->setCategoryId($array['category_id']);
        $obj->setName($array['name']);
        $obj->setModel($array['model']);
        $obj->setDescription($array['description']);
        $obj->setPrice($array['price']);
        $obj->setImage($array['image']);
        $obj->setCurrency($array['currency']);
        $obj->setStatus($array['status']);
        $obj->setCreatedAt($array['created_at']);
        $obj->setModifiedAt($array['modified_at']);

        return $obj;
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

    public static function fetchById($id) {
        return self::fetchBy(' id = ' . (int)$id);
    }

    public static function fetchByCategoryId($categoryId) {
        return self::fetchBy(' category_id = ' . (int)$categoryId);
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

    public function setCurrency($currency) {
        $this->currency = $currency;
    }
    public function getCurrency() {
        return $this->currency;
    }

    public function setImage($image) {
        $this->image = $image;
    }
    public function getImage() {
        return $this->image;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
    public function getPrice() {
        return $this->price;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setModel($model) {
        $this->model = $model;
    }
    public function getModel() {
        return $this->model;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }
    public function getCategoryId() {
        return $this->categoryId;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

}