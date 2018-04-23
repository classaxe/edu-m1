<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-22
 * Time: 16:11
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->addEntityType(
    'complexworld_eavblogpost',
    array(
        //entity_mode is the URI you'd pass into a Mage::getModel() call
        'entity_model'    => 'complexworld/eavblogpost',

        //table refers to the resource URI complexworld/eavblogpost
        //...eavblog_posts

        'table'           =>'complexworld/eavblogpost',
    )
);

$installer->createEntityTables(
    $installer->getTable('complexworld/eavblogpost')
);

$installer->addAttribute('complexworld_eavblogpost', 'title', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'varchar',
    'label'             => 'Title',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$installer->addAttribute('complexworld_eavblogpost', 'content', array(
    'type'              => 'text',
    'label'             => 'Content',
    'input'             => 'textarea',
));

$installer->addAttribute('complexworld_eavblogpost', 'date', array(
    'type'              => 'datetime',
    'label'             => 'Post Date',
    'input'             => 'datetime',
    'required'          => false,
));

$installer->endSetup();