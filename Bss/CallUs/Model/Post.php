<?php

namespace Bss\CallUs\Model;

class Post extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Cache tag
     * 
     * @var string
     */
    const CACHE_TAG = 'bss_callus_post';

    /**
     * Cache tag
     * 
     * @var string
     */
    protected $_cacheTag = 'bss_callus_post';

    /**
     * Event prefix
     * 
     * @var string
     */
    protected $_eventPrefix = 'bss_callus_post';


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bss\CallUs\Model\ResourceModel\Post');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * get entity default values
     *
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
    public function setProductName($productname)
    {
        $this->setData("productname", $productname);
    }
    public function setCustomerEmail($email)
    {
        $this->setData("email", $email);
    }
    public function setPhoneNumber($phonenumber)
    {
        $this->setData("telephone", $phonenumber);
    }
    public function setCompany($company)
    {
        $this->setData("company", $company);
    }
}
