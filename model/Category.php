<?php

class Category_Model extends Base_Model {

    const TABLE = 'categories';

    private $id;
    private $name;
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

    public static function fetchAll() {
        $conn = DBConnection::getConnection();
        $sql = 'SELECT *
                    FROM ' . self::TABLE . '
                    WHERE status > 0';

        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result AS $row) {
            $objects[] = self::arrayToClassObject($row);
        }

        return $objects;
    }

    private static function arrayToClassObject(array $array) {
        $obj = new self;
        $obj->setId($array['id']);
        $obj->setName($array['name']);
        $obj->setStatus($array['status']);
        $obj->setCreatedAt($array['created_at']);
        $obj->setModifiedAt($array['modified_at']);

        return $obj;
    }

    public static function fetchById($id) {
        return self::fetchBy(' id = ' . (int)$id);
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

    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

}