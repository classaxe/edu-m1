<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-22
 * Time: 19:40
 */
class Classaxe_Complexworld_Model_Resource_Eavblogpost_Collection extends Mage_Eav_Model_Entity_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('complexworld/eavblogpost');
    }
}