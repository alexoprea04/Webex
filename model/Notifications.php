<?php

class Notifications_Model extends Base_Model {

    const TABLE = 'user_notifications';

    private $id;
    private $userId;
    private $content;
    private $status;
    private $listId;
    private $listType;
    private $productId;


    const LIST_TYPE_WISHLIST = 1;
    const LIST_TYPE_RECCURENCE = 2;

    private static function arrayToClassObject(array $array) {
        $obj = new self;
        $obj->setId($array['id']);
        $obj->setUserId($array['user_id']);
        $obj->setContent($array['content']);
        $obj->setStatus($array['status']);
        $obj->setListId($array['list_id']);
        $obj->setListType($array['list_type']);
        $obj->setProductId($array['product_id']);

        return $obj;
    }

    public static function fetchAll() {
        $conn = DBConnection::getConnection();
        $sql = 'SELECT *
                    FROM ' . self::TABLE . '
                    WHERE  status > 0';
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $objects = array();
        foreach ($result AS $row) {
            $objects[] = self::arrayToClassObject($row);
        }

        return $objects;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }
    public function getProductId() {
        return $this->productId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function getUserId() {
        return $this->userId;
    }

    public function setListType($listType) {
        $this->listType = $listType;
    }
    public function getListType() {
        return $this->listType;
    }

    public function setListId($listId) {
        $this->listId = $listId;
    }
    public function getListId() {
        return $this->listId;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    public function getStatus() {
        return $this->status; 
    }
    
    public function setContent($content) {
        $this->content = $content;
    }
    public function getContent() {
        return $this->content; 
    }
    

    
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id; 
    }
}