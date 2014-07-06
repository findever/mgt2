<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Widget
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer \Magento\Core\Model\Resource\Setup */
$installer = $this;

$installer->startSetup();
$connection = $installer->getConnection();
$table = $installer->getTable('widget_instance');

$connection->changeColumn($table, 'package_theme', 'theme_id', array(
    'type'     => \Magento\DB\Ddl\Table::TYPE_INTEGER,
    'unsigned' => true,
    'nullable' => false,
    'comment'  => 'Theme id'
));

$connection->addForeignKey(
    $installer->getFkName('widget_instance', 'theme_id', 'core_theme', 'theme_id'),
    $table,
    'theme_id',
    $installer->getTable('core_theme'),
    'theme_id',
    \Magento\DB\Ddl\Table::ACTION_CASCADE,
    \Magento\DB\Ddl\Table::ACTION_CASCADE
);

$installer->endSetup();
