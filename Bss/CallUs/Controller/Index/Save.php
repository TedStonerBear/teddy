<?php


namespace Bss\CallUs\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Bss\CallUs\Model\PostFactory;
use Magento\Framework\View\Result\PageFactory;

class Save extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $_postFactory;
    protected $_resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        ResultFactory $ResultFactory,
        PostFactory $postFactory,
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->_resultFactory = $ResultFactory;
        $this->_postFactory = $postFactory;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        $model = $this->_postFactory->create();
        if (!empty($data)) {
            $productname = $data["prodname"];
            $phone = $data["phone"];
            $email = $data["email"];
            $company = $data["company"];
            $model->setProductName($productname);
            $model->setCustomerEmail($email);
            $model->setPhoneNumber($phone);
            $model->setCompany($company);
            $model->save();
        }
        echo "<script type='text/javascript'>alert('$company');</script>";
        return $resultRedirect;
        
    }
}