<?php

class Recurrent_Controller extends Base_Controller {
	
    public function index() {
		if($this->hasList()) {
				$sql = $this->db->prepare("
					SELECT *
					FROM reccurent_lists
					WHERE user_id = '".$this->app_user."'
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
		if(isset($_POST)){
			var_dump($_POST);
		}
	}	
	
}