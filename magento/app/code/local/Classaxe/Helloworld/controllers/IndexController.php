<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-09
 * Time: 17:24
 */
class Classaxe_Helloworld_IndexController extends Mage_Core_Controller_Front_Action {
    public function indexAction() {
        echo 'Hello Index!';
    }

    public function goodbyeAction() {
        echo 'Goodbye World!';
    }

    public function paramsAction() {
        echo '<dl>';
        foreach($this->getRequest()->getParams() as $key=>$value) {
            echo '<dt><strong>Param: </strong>'.$key.'</dt>';
            echo '<dl><strong>Value: </strong>'.$value.'</dl>';
        }
        echo '</dl>';
    }
}