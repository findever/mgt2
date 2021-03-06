<?php
/**
 * Helper to obtain post data for postData widget
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 *
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
 * @package     Magento_Core
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Core\Helper;

class PostData extends \Magento\App\Helper\AbstractHelper
{
    /**
     * Form key
     *
     * @var \Magento\Data\Form\FormKey
     */
    protected $_formKey;

    /**
     * @param \Magento\App\Helper\Context $context
     * @param \Magento\Data\Form\FormKey $formKey
     */
    public function __construct(
        \Magento\App\Helper\Context $context,
        \Magento\Data\Form\FormKey $formKey
    ) {
        parent::__construct($context);
        $this->_formKey = $formKey;
    }

    /**
     * get data for post by javascript in format acceptable to $.mage.dataPost widget
     *
     * @param string $url
     * @param array $data
     * @return string
     */
    public function getPostData($url, array $data = array())
    {
        if (!isset($data['form_key'])) {
            $data['form_key'] = $this->_formKey->getFormKey();
        }
        if (!isset($data[\Magento\App\Action\Action::PARAM_NAME_URL_ENCODED])) {
            $data[\Magento\App\Action\Action::PARAM_NAME_URL_ENCODED] = $this->getEncodedUrl();
        }
        return json_encode(['action' => $url, 'data' => $data]);
    }

    /**
     * Get current encoded url
     *
     * @param string|null $url
     * @return string
     */
    public function getEncodedUrl($url = null)
    {
        if (!$url) {
            $url = $this->_urlBuilder->getCurrentUrl();
        }
        return $this->urlEncode($url);
    }
}
