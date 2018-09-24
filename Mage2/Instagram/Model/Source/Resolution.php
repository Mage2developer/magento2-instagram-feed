<?php

namespace Mage2\Instagram\Model\Source;

class Resolution implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var $options
     */
    protected $options;

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {

        $this->options = [
            ['label' => '150px x 150px', 'value' => 'thumbnail'],
            ['label' => '306px x 306px', 'value' => 'low_resolution'],
            ['label' => '612px x 612px', 'value' => 'standard_resolution'],
        ];
        return $this->options;
    }
}
