<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-09
 * Time: 17:30
 */
class Classaxe_Helloworld_MessagesController extends Mage_Core_Controller_Front_Action {
    public function goodbyeAction() {
        echo 'Another Goodbye message';
        return;
        $this->loadLayout();
        $this->renderLayout();
    }
}