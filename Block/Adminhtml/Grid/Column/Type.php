<?php

namespace Sifuen\SuppressOutOfDateDb\Block\Adminhtml\Grid\Column;

/**
 * Class Type
 * @package Sifuen\SuppressOutOfDateDb\Block\Adminhtml\Grid\Column
 */
class Type extends \Magento\Backend\Block\Widget\Grid\Column
{
    /**
     * @return string
     */
    public function getFrameCallback()
    {
        return [$this, 'ucfirst'];
    }

    /**
     * @param $value
     * @return string
     */
    public function ucfirst($value)
    {
        return ucfirst($value);
    }
}
