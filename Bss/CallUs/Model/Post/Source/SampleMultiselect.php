<?php
namespace Bss\CallUs\Model\Post\Source;

class SampleMultiselect implements \Magento\Framework\Option\ArrayInterface
{
    const _EMPTY = 1;
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::_EMPTY,
                'label' => __('')
            ],
        ];
        return $options;

    }
}
