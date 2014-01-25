<?php

class Wishlist_Controller extends Base_Controller {

    public function addItem() {
        //do nothing ?
    }

    public function saveItem() {
        //receive data
        $name = $_POST['name'];
        $description = $_POST['description'];

        $list = new Wishlist_Model();
        $list->setName($name);
        $list->setDescription($description);
        $list->setUserId(1);

        $list->save();
die;
        //redirect to listItems
        header('Location: ' . Config::baseDir . 'Wishlist/listProducts/');
    }

    public function listItems() {
        $wishlists = new Wishlist_Model();
        $results = $wishlists->fetchAll();

        $this->addVar('lists', $results);
    }

    public function listProducts() {
        $products = new Products_Model();
        $results = $products->fetchAll();

        $this->addVar('products', $results);
    }

}