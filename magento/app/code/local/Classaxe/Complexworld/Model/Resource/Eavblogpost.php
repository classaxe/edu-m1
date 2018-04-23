<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-22
 * Time: 16:50
 */
class Classaxe_Complexworld_Model_Resource_Eavblogpost extends Mage_Eav_Model_Entity_Abstract
{
    protected function _construct()
    {
        $resource = Mage::getSingleton('core/resource');
        $this->setType('complexworld_eavblogpost');
        $this->setConnection(
            $resource->getConnection('complexworld_read'),
            $resource->getConnection('complexworld_write')
        );
    }
}