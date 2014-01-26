<?php

class Recurrent_Controller extends Base_Controller {

	public $app_user = 1;
	
    public function index() {
		if($this->hasList()) {
				$sql = $this->db->prepare("
					SELECT r.*, (SELECT COUNT(*) FROM reccurent_products WHERE reccurent_list_id = r.id) AS produse
					FROM reccurent_lists AS r
					WHERE r.user_id = '".$this->app_user."'
					ORDER BY next_shopping_date ASC
					");
				$sql->execute();
				$lists = $sql->fetchAll(PDO::FETCH_ASSOC);	
				
				$this->addVar('display-nolist', 'none');				
				$this->addVar('display-list', 'block');		
				$this->addVar('lists', $lists);
		}
		else {
				$this->addVar('display-nolist', 'block');				
				$this->addVar('display-list', 'none');	
		}
    }
	
	//check to see user has list
	public function hasList()
	{
		$sql = $this->db->prepare("
			SELECT COUNT(id) AS nr
			FROM reccurent_lists
			WHERE user_id = '".$this->app_user."'
			");
		$sql->execute();
		$lists = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		if($lists[0]['nr'] == 0) {
			return false;
		}
		else {
			return true;
		}
	}
	
	//create list
	public function createList()
	{	
		//user post
		if($_POST) {
			//receive data
			$list = new Recurrent_Model();
			$list->setName($_POST['name']);
			$list->setDescription($_POST['description']);
			$list->setUserId(1);
			$list->setStatus(0);
			$list->setShoppingInterval($_POST['days']);
			$list->setLastShoppingDate(date('Y-m-d', time()));
			$list->setNextShoppingDate(date('Y-m-d', time() + $_POST['days'] * 24 * 60 * 60));
			$list->setCreatedAt(date('Y-m-d H:i:s', time()));

			$list->save();
			header('Location: ' . Config::baseDir . 'Recurrent/listProducts/');
		}
	}	
	
	public function listProducts()
	{
        if (!isset($_GET['id'])) {
            header('Location: ' . Config::baseDir . 'Recurrent/index/');
        }
		
        $list = Recurrent_Model::fetchById($_GET['id']);
		$products = $list->fetchProducts();

        $this->addVar('list', $list);
        $this->addVar('products', $products);
	}

    public function saveProductsToList() {
        if (!isset($_POST['listId']) || !$_POST['products']) {
            header('Location: ' . Config::baseDir . 'Recurrent/index/');
        }

        $listId = (int)$_POST['listId'];
        $products = $_POST['products'];
		
        $list = Recurrent_Model::fetchById($listId);
        $list->removeAllProducts();
        foreach ($products AS $productId) {
            $productQuantity = $_POST['product_quantity_' . $productId];
			echo $productQuantity;
            $list->addProduct($productId, $productQuantity);
        }

        header('Location: ' . Config::baseDir . 'Recurrent/index/?message=lista a fost adaugata');

    }	

    public function saveItem() {
        //receive data
        if (isset($_POST['name']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $list = new Recurrent_Model();
            $list->setName($name);
            $list->setDescription($description);
            $list->setUserId(1);
            $list->setStatus(1);
			$list->setShoppingInterval($_POST['days']);
			$list->setLastShoppingDate(date('Y-m-d', time()));
			$list->setNextShoppingDate(date('Y-m-d', time() + $_POST['days'] * 24 * 60 * 60));
			$list->setCreatedAt(date('Y-m-d H:i:s', time()));
			
            $list = $list->save();

            //redirect to listItems
            // @TODO - maybe redirect to categories listing and then to products from a categ ?
            header('Location: /Recurrent/searchProducts/?listId=' . $list->getId());
            return;
        }
        header('Location: /Recurrent/listItems/');
    }	

    public function searchProducts() {
        if(!isset($_GET['listId'])) {
            header('Location: ' . Config::baseDir . 'Recurrent/listItems/');
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
	
}