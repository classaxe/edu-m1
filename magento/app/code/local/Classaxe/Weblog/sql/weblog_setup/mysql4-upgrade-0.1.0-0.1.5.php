<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-22
 * Time: 14:29
 */

echo 'Testing our upgrade script (mysql4-mysql4-upgrade-0.1.0-0.1.5.php) and NOT halting execution <br />';

$installer = $this;

$installer->startSetup();

$installer->run("
    INSERT INTO `{$installer->getTable('weblog/blogpost')}` VALUES (1,'My New Title','This is a blog post','2009-07-01 00:00:00','2009-07-02 23:12:30');
");

$installer->endSetup();