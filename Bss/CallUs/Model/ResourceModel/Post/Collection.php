<?php
namespace Bss\CallUs\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'bss_callus_post_collection';
    protected $_eventObject = 'post_collection';
    protected function _construct()
    {
        $this->_init('Bss\CallUs\Model\Post', 'Bss\CallUs\Model\ResourceModel\Post');
    }
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(\Zend_Db_Select::GROUP);
        return $countSelect;
    }
    protected function _toOptionArray($valueField = 'post_id', $labelField = 'name', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
}
