<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-22
 * Time: 08:53
 */
class Classaxe_Weblog_Model_Resource_Blogpost_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    protected function _construct()
    {
        $this->_init('weblog/blogpost');
    }
}