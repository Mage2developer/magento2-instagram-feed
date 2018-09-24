<?php

namespace Mage2\Instagram\Model\Source;

class Mode implements \Magento\Framework\Option\ArrayInterface
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
            ['label' => 'Sand Box', 'value' => '0'],
            ['label' => 'Live', 'value' => '1'],
        ];
        return $this->options;
    }
}
