<?php

class Test_Controller extends Base_Controller {

    public function index() {

        //add var to view
        $this->addVar('kkk', 'kkk value');
    }

}