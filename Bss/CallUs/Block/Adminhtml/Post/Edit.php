<?php
namespace Bss\CallUs\Block\Adminhtml\Post;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry;
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }
    protected function _construct()
    {
        $this->_objectId = 'post_id';
        $this->_blockGroup = 'Bss_CallUs';
        $this->_controller = 'adminhtml_post';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Post'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Post'));
    }
    public function getHeaderText()
    {
        $post = $this->_coreRegistry->registry('bss_callus_post');
        if ($post->getId()) {
            return __("Edit Post '%1'", $this->escapeHtml($post->getName()));
        }
        return __('New Post');
    }
}
