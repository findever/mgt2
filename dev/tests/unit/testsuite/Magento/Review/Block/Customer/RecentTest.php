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
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Review\Block\Customer;

use Magento\TestFramework\Helper\ObjectManager as ObjectManagerHelper;

class RecentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Magento\Review\Block\Customer\Recent */
    protected $object;

    /** @var ObjectManagerHelper */
    protected $objectManagerHelper;

    /** @var \Magento\View\Element\Template\Context|\PHPUnit_Framework_MockObject_MockObject */
    protected $context;

    /** @var \Magento\Review\Model\Resource\Review\Product\Collection|\PHPUnit_Framework_MockObject_MockObject */
    protected $collection;

    /** @var \Magento\Review\Model\Resource\Review\Product\CollectionFactory|\PHPUnit_Framework_MockObject_MockObject */
    protected $collectionFactory;

    /** @var \Magento\Customer\Model\Session|\PHPUnit_Framework_MockObject_MockObject */
    protected $session;

    /** @var \Magento\Core\Model\StoreManagerInterface|\PHPUnit_Framework_MockObject_MockObject */
    protected $storeManager;

    protected function setUp()
    {
        $this->storeManager = $this->getMock('\Magento\Core\Model\StoreManagerInterface');
        $this->context = $this->getMock('Magento\View\Element\Template\Context', [], [], '', false);
        $this->context->expects($this->any())->method('getStoreManager')->will($this->returnValue($this->storeManager));
        $this->collection
            = $this->getMock('Magento\Review\Model\Resource\Review\Product\Collection', [], [], '', false);
        $this->collectionFactory = $this->getMock(
            'Magento\Review\Model\Resource\Review\Product\CollectionFactory',
            ['create'],
            [],
            '',
            false
        );
        $this->collectionFactory->expects($this->once())->method('create')
            ->will($this->returnValue($this->collection));
        $this->session = $this->getMock('Magento\Customer\Model\Session', [], [], '', false);

        $this->objectManagerHelper = new ObjectManagerHelper($this);
        $this->object = $this->objectManagerHelper->getObject('Magento\Review\Block\Customer\Recent', [
            'context' => $this->context,
            'collectionFactory' => $this->collectionFactory,
            'customerSession' => $this->session
        ]);
    }

    public function testGetCollection()
    {
        $this->storeManager->expects($this->any())->method('getStore')
            ->will($this->returnValue(new \Magento\Object(['id' => 42])));
        $this->session->expects($this->any())->method('getCustomerId')->will($this->returnValue(4242));

        $this->collection->expects($this->any())->method('addStoreFilter')->with(42)
            ->will($this->returnValue($this->collection));
        $this->collection->expects($this->any())->method('addCustomerFilter')->with(4242)
            ->will($this->returnValue($this->collection));
        $this->collection->expects($this->any())->method('setDateOrder')->with()
            ->will($this->returnValue($this->collection));
        $this->collection->expects($this->any())->method('setPageSize')->with(5)
            ->will($this->returnValue($this->collection));
        $this->collection->expects($this->any())->method('load')->with()
            ->will($this->returnValue($this->collection));
        $this->collection->expects($this->any())->method('addReviewSummary')->with()
            ->will($this->returnValue($this->collection));

        $this->assertSame($this->collection, $this->object->getCollection());
    }
}
