<?php

class Wishlist_Controller extends Base_Controller {

    public function addItem() {
        //do nothing ?
    }

    public function saveItem() {
        //receive data
        if (isset($_POST['name']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $list = new Wishlist_Model();
            $list->setName($name);
            $list->setDescription($description);
            $list->setUserId(1);
            $list->setStatus(1);

            $list = $list->save();

            //redirect to listItems
            // @TODO - maybe redirect to categories listing and then to products from a categ ?
            header('Location: ' . Config::baseDir . 'Wishlist/listProducts/?listId=' . $list->getId());
        }
        header('Location: ' . Config::baseDir . 'Wishlist/listItems/');
    }

    public function listItems() {
        $wishlists = new Wishlist_Model();
        $results = $wishlists->fetchAll();

        $this->addVar('lists', $results);
    }

    public function listCategories() {
        $categories = Category_Model::fetchAll();

        $this->addVar('categories', $categories);
    }

    public function listProducts() {
        if(!isset($_GET['listId'])) {
            header('Location: ' . Config::baseDir . 'Wishlist/listItems/');
        }

        if (isset($_GET['category_id']) && (int)$_GET['category_id'] > 0) {
            $results = Products_Model::fetchAllByCategoryId((int)$_GET['category_id']);
        } else {
            $results = Products_Model::fetchAll();
        }

        $this->addVar('listId', $_GET['listId']);
        $this->addVar('products', $results);
    }

    public function saveProductsToList() {
        if (!isset($_POST['listId']) || !$_POST['products']) {
            header('Location: ' . Config::baseDir . 'Wishlist/listItems/');
        }

        $listId = (int)$_POST['listId'];
        $products = $_POST['products'];

        $list = Wishlist_Model::fetchById($listId);
        foreach ($products AS $productId) {
            $productPrice = $_POST['product_price_' . $productId];
            $list->addProduct($productId, $productPrice);
        }

        header('Location: ' . Config::baseDir . 'Wishlist/listItems/?message=lista a fost adaugata');

    }

}