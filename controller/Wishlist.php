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
            return;
        }
        header('Location: ' . Config::baseDir . 'Wishlist/listItems/');
    }

    public function listItems() {

        $results = Wishlist_Model::fetchAll();

        $this->addVar('lists', $results);
    }

    public function listCategories() {
        $categories = Category_Model::fetchAll();

        $this->addVar('categories', $categories);
    }

    /**
     * used for adding products
     */
    public function listProducts() {
        if(!isset($_GET['listId'])) {
            header('Location: ' . Config::baseDir . 'Wishlist/listItems/');
        }
        $category = new Category_Model();
        if (isset($_GET['categoryId']) && (int)$_GET['categoryId'] > 0) {
            $category = Category_Model::fetchById($_GET['categoryId']);
            $results = Products_Model::fetchAllByCategoryId((int)$_GET['categoryId']);
        } else {
            $results = Products_Model::fetchAll();
        }

        $categories = Category_Model::fetchAll();

        $this->addVar('categories', $categories);
        $this->addVar('category', $category);
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
            $list->removeProductsById($productId);
            $productPrice = $_POST['product_price_' . $productId];
            $list->addProduct($productId, $productPrice);
        }

        header('Location: ' . Config::baseDir . 'Wishlist/listItems/?message=lista a fost adaugata');

    }

    /**
     * list products for a list
     */
    public function listProductsForList() {
        if (!isset($_GET['listId'])) {
            header('Location: ' . Config::baseDir . 'Wishlist/listItems/');
        }

        $list = Wishlist_Model::fetchById($_GET['listId']);
        $products = $list->fetchProducts();

        $this->addVar('list', $list);
        $this->addVar('products', $products);
    }

    public function productDetail() {
        if (!isset($_GET['productId']) || !isset($_GET['listId'])) {
            header('Location: ' . Config::baseDir . 'Wishlist/listItems/');
        }

        $productId = $_GET['productId'];
        $listId = $_GET['listId'];

        $product = Products_Model::fetchById($productId);
        $list = Wishlist_Model::fetchById($listId);

        $this->addVar('product', $product);
        $this->addVar('list', $list);
    }

}