<?php
class Products_Model extends Base_Model {

    const TABLE = 'categories';

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
        $this->setId($array['id']);
        $this->setCategoryId($array['category_id']);
        $this->setName($array['name']);
        $this->setModel($array['model']);
        $this->setDescription($array['description']);
        $this->setPrice($array['price']);
        $this->setImage($array['image']);
        $this->setCurrency($array['currency']);
        $this->setStatus($array['status']);
        $this->setCreatedAt($array['created_at']);
        $this->setModifiedAt($array['modified_at']);

        return $this;
    }

    private function fetchBy($cond) {
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

    public function fetchById($id) {
        return $this->fetchBy(' id = ' . (int)$id);
    }

    public function fetchByCategoryId($categoryId) {
        return $this->fetchBy(' category_id = ' . (int)$categoryId);
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