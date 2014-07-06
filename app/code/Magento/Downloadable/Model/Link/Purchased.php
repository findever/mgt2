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
 * @package     Magento_Downloadable
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Downloadable links purchased model
 *
 * @method \Magento\Downloadable\Model\Resource\Link\Purchased _getResource()
 * @method \Magento\Downloadable\Model\Resource\Link\Purchased getResource()
 * @method int getOrderId()
 * @method \Magento\Downloadable\Model\Link\Purchased setOrderId(int $value)
 * @method string getOrderIncrementId()
 * @method \Magento\Downloadable\Model\Link\Purchased setOrderIncrementId(string $value)
 * @method int getOrderItemId()
 * @method \Magento\Downloadable\Model\Link\Purchased setOrderItemId(int $value)
 * @method string getCreatedAt()
 * @method \Magento\Downloadable\Model\Link\Purchased setCreatedAt(string $value)
 * @method string getUpdatedAt()
 * @method \Magento\Downloadable\Model\Link\Purchased setUpdatedAt(string $value)
 * @method int getCustomerId()
 * @method \Magento\Downloadable\Model\Link\Purchased setCustomerId(int $value)
 * @method string getProductName()
 * @method \Magento\Downloadable\Model\Link\Purchased setProductName(string $value)
 * @method string getProductSku()
 * @method \Magento\Downloadable\Model\Link\Purchased setProductSku(string $value)
 * @method string getLinkSectionTitle()
 * @method \Magento\Downloadable\Model\Link\Purchased setLinkSectionTitle(string $value)
 *
 * @category    Magento
 * @package     Magento_Downloadable
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Downloadable\Model\Link;

class Purchased extends \Magento\Core\Model\AbstractModel
{
    /**
     * Enter description here...
     *
     */
    protected function _construct()
    {
        $this->_init('Magento\Downloadable\Model\Resource\Link\Purchased');
        parent::_construct();
    }

    /**
     * Check order id
     *
     * @return \Magento\Core\Model\AbstractModel
     */
    public function _beforeSave()
    {
        if (null == $this->getOrderId()) {
            throw new \Exception(
                __('Order id cannot be null'));
        }
        return parent::_beforeSave();
    }

}
