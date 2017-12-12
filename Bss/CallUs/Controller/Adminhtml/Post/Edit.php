<?php
namespace Bss\CallUs\Controller\Adminhtml\Post;

class Edit extends \Bss\CallUs\Controller\Adminhtml\Post
{
    protected $_backendSession;
    protected $_resultPageFactory;
    protected $_resultJsonFactory;
    public function __construct(
        \Magento\Backend\Model\Session $backendSession,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Bss\CallUs\Model\PostFactory $postFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_backendSession    = $backendSession;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($postFactory, $registry, $resultRedirectFactory, $context);
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_CallUs::post');
    }
    public function execute()
    {
        $id = $this->getRequest()->getParam('post_id');
        $post = $this->_initPost();
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Bss_CallUs::post');
        $resultPage->getConfig()->getTitle()->set(__('Posts'));
        if ($id) {
            $post->load($id);
            if (!$post->getId()) {
                $this->messageManager->addError(__('This Post no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'bss_callus/*/edit',
                    [
                        'post_id' => $post->getId(),
                        '_current' => true
                    ]
                );
                return $resultRedirect;
            }
        }
        $title = $post->getId() ? $post->getName() : __('New Post');
        $resultPage->getConfig()->getTitle()->prepend($title);
        $data = $this->_backendSession->getData('bss_callus_post_data', true);
        if (!empty($data)) {
            $post->setData($data);
        }
        return $resultPage;
    }
}
