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
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Cache\Config;

class Converter implements \Magento\Config\ConverterInterface
{
    /**
     * Convert dom node tree to array
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $output = array();
        /** @var \DOMNodeList $types */
        $types = $source->getElementsByTagName('type');
        /** @var \DOMNode $type */
        foreach ($types as $type) {
            $typeConfig = array();
            foreach ($type->attributes as $attribute) {
                $typeConfig[$attribute->nodeName] = $attribute->nodeValue;
            }
            /** @var \DOMNode $childNode */
            foreach ($type->childNodes as $childNode) {
                if ($childNode->nodeType == XML_ELEMENT_NODE
                    || ($childNode->nodeType == XML_CDATA_SECTION_NODE
                    || ($childNode->nodeType == XML_TEXT_NODE && trim($childNode->nodeValue) != ''))
                ) {
                    $typeConfig[$childNode->nodeName] = $childNode->nodeValue;
                }
            }
            $output[$type->attributes->getNamedItem('name')->nodeValue] = $typeConfig;
        }
        return array('types' => $output);
    }
}
