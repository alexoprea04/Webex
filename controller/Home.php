<?php

class Home_Controller extends Base_Controller {

    public function index() {

        $notifications = Notifications_Model::fetchAll();
        $this->addVar('notifications', $notifications);
    }

}