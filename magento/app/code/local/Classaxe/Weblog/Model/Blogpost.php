<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-21
 * Time: 17:09
 */
class Classaxe_Weblog_Model_Blogpost extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('weblog/blogpost');
    }
}