<?php
namespace Bss\CallUs\Controller\Adminhtml;
abstract class Post extends \Magento\Backend\App\Action
{
    protected $_postFactory;
    protected $_coreRegistry;
    protected $_resultRedirectFactory;
    public function __construct(
        \Bss\CallUs\Model\PostFactory $postFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_postFactory           = $postFactory;
        $this->_coreRegistry          = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }
    protected function _initPost()
    {
        $postId  = (int) $this->getRequest()->getParam('post_id');
        $post    = $this->_postFactory->create();
        if ($postId) {
            $post->load($postId);
        }
        $this->_coreRegistry->register('bss_callus_post', $post);
        return $post;
    }
}
