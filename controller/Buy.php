<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexandru.oprea
 * Date: 25.01.2014
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */
 
class Buy_Controller extends Base_Controller {

    public function product() {
				$sql = $this->db->prepare("
					SELECT products.id, products.name, products.description, products.price, products.image, categories.name AS cname
					FROM products
					LEFT JOIN categories ON categories.id = products.category_id
					WHERE products.id = '".$_GET['id']."'
					LIMIT 1;
					");
				$sql->execute();
				$product = $sql->fetchAll(PDO::FETCH_ASSOC);	
				
				$this->addVar('product', $product[0]);	
    }
	
    public function ok() {
				$sql = $this->db->prepare("
					SELECT products.id, products.name, products.description, products.price, products.image, categories.name AS cname
					FROM products
					LEFT JOIN categories ON categories.id = products.category_id
					WHERE products.id = '".$_GET['id']."'
					LIMIT 1;
					");
				$sql->execute();
				$product = $sql->fetchAll(PDO::FETCH_ASSOC);	
				
				$this->addVar('product', $product[0]);	
    }
}
?>
