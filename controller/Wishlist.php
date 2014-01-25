<?php

class Wishlist_Controller extends Base_Controller {

    public function addForm() {

    }

    public function saveForm() {

    }

    public function listItems() {
        $wishlists = new Wishlist_Model();
        $results = $wishlists->fetchAll();

        $this->addVar('lists', $results);
    }

    public function listProducts() {

    }

}