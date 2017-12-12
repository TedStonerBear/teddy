<?php
namespace Bss\CallUs\Model\Post\Source;

class MultiselectField implements \Magento\Framework\Option\ArrayInterface
{
    const OPTION_1 = 1;
    const OPTION_2 = 2;
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::OPTION_1,
                'label' => __('Option 1')
            ],
            [
                'value' => self::OPTION_2,
                'label' => __('Option 2')
            ],
        ];
        return $options;

    }
}
