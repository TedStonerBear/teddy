<?php
namespace Bss\Bestseller\Block;
class Bestseller extends \Magento\Framework\View\Element\Template
{    
    protected $_coreRegistry = null;
    protected $_storeManager;
    protected $_productCollectionFactory;
    protected $_listProductBlock;
    protected $_reviewFactory;
        
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Block\Product\ListProduct $listProductBlock, 
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        array $data = []
    ) 
    {
        $this->_reviewFactory = $reviewFactory;
        $this->_storeManager = $storeManager;
        $this->_catalogProductVisibility = $catalogProductVisibility;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_listProductBlock = $listProductBlock;
        parent::__construct($context, $data);
    }

    public function _prepareLayout() //Assign XML to the template and render.
    {
        return parent::_prepareLayout();
    }
    
    public function getProductCollection()
    {   
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('status', ['eq'=>'1']);
        $collection->addAttributeToFilter('visibility',['eq'=>'4']);
        $collection->addAttributeToSort('entity_id', 'desc');
        $collection->setPageSize(8)->setCurPage(1);
        return $collection;
    }

    public function getBestSellerData() //Bestseller Collection
    {
        $storeId = $this->_storeManager->getStore(true)->getId();
        $collection = $this->_productCollectionFactory->create()->addAttributeToSelect('*');
        $collection->addStoreFilter()
                    ->joinField(
                        'qty_ordered',
                        'sales_bestsellers_aggregated_monthly',
                        'qty_ordered',
                        'product_id=entity_id',
                        'at_qty_ordered.store_id='.$storeId,
                        'at_qty_ordered.qty_ordered > 0',
                        'left'
                    )->setPageSize(8)->setCurPage(1);
        $collection->addAttributeToSort('qty_ordered', 'desc');
        return $collection;
    }

    public function getAddToCartPostParams($product)
    {
        return $this->_listProductBlock->getAddToCartPostParams($product);
    }

    public function getCurrentStoreId()
    {   
        return $this->_storeManager->getStore()->getStoreId();
    } 
    public function getRatingSummary($product)
    {    
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $_reviewFactory = $_objectManager->create('Magento\Review\Model\Review');
        $_reviewFactory->getEntitySummary($product);
        $_reviewCount = $product->getRatingSummary()->getReviewsCount();
        return $_reviewCount;
    }
    public function getRatingReviews($product)
    {
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $_reviewFactory = $_objectManager->create('Magento\Review\Model\Review');
        $_reviewFactory->getEntitySummary($product);
        $_ratingSummary = $product->getRatingSummary()->getRatingSummary();
        return $_ratingSummary;
    }
}
