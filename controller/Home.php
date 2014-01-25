<?php

class Home_Controller extends Base_Controller {

    public function index() {

        //test db connection
        $random = $this->db->prepare('
                    SELECT 1');
        $random->execute();
        $product = $random->fetchAll(PDO::FETCH_ASSOC);
        


        //add var to view
        $this->addVar('kkk', 'kkk value');
    }

}