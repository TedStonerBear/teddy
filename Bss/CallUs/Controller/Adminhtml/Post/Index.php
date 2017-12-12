<?php
namespace Bss\CallUs\Controller\Adminhtml\Post;

class Index extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_resultPage;
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $this->_setPageData();
        return $this->getResultPage();
    }
    public function getResultPage()
    {
        if (is_null($this->_resultPage)) {
            $this->_resultPage = $this->_resultPageFactory->create();
        }
        return $this->_resultPage;
    }
    protected function _setPageData()
    {
        $resultPage = $this->getResultPage();
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));
        return $this;
    }
}
